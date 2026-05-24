@php
    $selectedRef = old('imageable_ref', $selectedRef ?? null);
@endphp

<div class="col-md-12">
    <label class="form-label">Bog'langan yozuv *</label>
    <select name="imageable_ref" class="form-select @error('imageable_ref') is-invalid @enderror">
        <option value="">Tanlang</option>
        <optgroup label="Yangiliklar">
            @foreach ($news as $item)
                <option value="news:{{ $item->id }}" @selected($selectedRef === 'news:'.$item->id)>
                    {{ $item->title_uz }}
                </option>
            @endforeach
        </optgroup>
        <optgroup label="Laboratoriyalar">
            @foreach ($laboratories as $item)
                <option value="laboratory:{{ $item->id }}" @selected($selectedRef === 'laboratory:'.$item->id)>
                    {{ $item->name_uz }}
                </option>
            @endforeach
        </optgroup>
    </select>
    @error('imageable_ref')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
