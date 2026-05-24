<?php

namespace App\Http\Controllers\Concerns;

use App\Enums\ImageableType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait HandlesModelImages
{
    protected function storeUploadedImages(Model $model, Request $request, ImageableType $type, string $field = 'images'): void
    {
        if (! $request->hasFile($field)) {
            return;
        }

        foreach ($request->file($field) as $uploadedImage) {
            $model->images()->create([
                'image' => $uploadedImage->store($type->storageDirectory(), 'public'),
                'is_active' => true,
            ]);
        }
    }

    protected function deleteModelImages(Model $model): void
    {
        foreach ($model->images as $image) {
            if ($image->image && Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }
        }
    }
}
