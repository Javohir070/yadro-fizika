<div class="col-md-12">
    <label class="form-label">Yangi rasmlar qo'shish</label>
    <input type="file" name="images[]" multiple
        class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
        accept=".jpg,.jpeg,.png,.webp">
    @error('images')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @error('images.*')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@if (isset($model) && $model->images->isNotEmpty())
    <div class="col-md-12">
        <label class="form-label">Mavjud rasmlar</label>
        <div class="d-flex flex-wrap gap-2">
            @foreach ($model->images as $image)
                <img src="{{ asset('storage/' . $image->image) }}" alt="Image"
                    style="width: 90px; height: 60px; object-fit: cover;" class="rounded border">
            @endforeach
        </div>
    </div>
@endif
