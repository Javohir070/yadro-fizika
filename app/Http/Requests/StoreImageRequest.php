<?php

namespace App\Http\Requests;

use App\Enums\ImageableType;
use Illuminate\Foundation\Http\FormRequest;

class StoreImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'imageable_ref' => ['required', 'string', 'regex:/^(news|laboratory):\d+$/'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
            'is_active' => ['required', 'boolean'],
        ];
    }

    public function imageableType(): ImageableType
    {
        return ImageableType::from(explode(':', $this->validated()['imageable_ref'])[0]);
    }

    public function imageableId(): int
    {
        return (int) explode(':', $this->validated()['imageable_ref'])[1];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator): void {
            if ($validator->errors()->isNotEmpty() || ! $this->filled('imageable_ref')) {
                return;
            }

            if (! preg_match('/^(news|laboratory):(\d+)$/', $this->input('imageable_ref'), $matches)) {
                return;
            }

            $type = ImageableType::from($matches[1]);
            $id = (int) $matches[2];
            $modelClass = $type->modelClass();

            if (! $modelClass::query()->whereKey($id)->exists()) {
                $validator->errors()->add('imageable_ref', 'Tanlangan yozuv topilmadi.');
            }
        });
    }
}
