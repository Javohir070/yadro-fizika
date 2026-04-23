<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Ro‘yxat (index) API uchun umumiy validatsiya.
 *
 * Keyingi dasturchilar uchun:
 * - `status`: 1 = faqat aktiv yozuvlar, 0 = nofaol (admin/test uchun).
 * - `lang`: matn maydonlari shu tilga qarab JSONda qisqartiriladi (title, name, …).
 * - `page` / `per_page`: Laravel paginator bilan mos; per_page yuqori chegarasi — server hujjumi oldini olish.
 */
class ApiListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => 'required|in:1,0',
            'lang' => 'required|in:uz,ru,en',
            'page' => 'sometimes|integer|min:1',
            'per_page' => 'sometimes|integer|min:1|max:50',
        ];
    }

    protected function prepareForValidation(): void
    {
        if (! $this->has('page')) {
            $this->merge(['page' => 1]);
        }
        if (! $this->has('per_page')) {
            $this->merge(['per_page' => 15]);
        }
    }
}
