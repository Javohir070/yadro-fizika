@php
    $scientific = $laboratory->scientificActivity;
    $formAction = $scientific
        ? route('admin.laboratories.scientific-activities.update', [$laboratory, $scientific])
        : route('admin.laboratories.scientific-activities.store', $laboratory);
@endphp

<div class="mb-4">
    <h5 class="fw-semibold mb-1">Ilmiy faoliyat</h5>
    <p class="text-body-tertiary mb-0 fs-9">Laboratoriyaning ilmiy faoliyati haqida matn</p>
</div>

<form action="{{ $formAction }}" method="POST">
    @csrf
    @if ($scientific)
        @method('PUT')
    @endif

    <ul class="nav nav-underline mb-3" id="scientific-lang-tabs">
        <li class="nav-item col text-center">
            <button type="button" class="nav-link scientific-lang-tab-btn active fw-semibold w-100 border-0 bg-transparent" data-lang="uz">O'zbekcha</button>
        </li>
        <li class="nav-item col text-center">
            <button type="button" class="nav-link scientific-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent" data-lang="ru">Ruscha</button>
        </li>
        <li class="nav-item col text-center">
            <button type="button" class="nav-link scientific-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent" data-lang="en">English</button>
        </li>
    </ul>

    <div class="row g-3 scientific-lang-panel" data-lang-panel="uz">
        <x-admin.summernote-field name="details_uz" label="Ilmiy faoliyat (UZ)" :value="old('details_uz', $scientific?->details_uz)" :rows="8" :height="480" />
    </div>
    <div class="row g-3 scientific-lang-panel d-none" data-lang-panel="ru">
        <x-admin.summernote-field name="details_ru" label="Ilmiy faoliyat (RU)" :value="old('details_ru', $scientific?->details_ru)" :rows="6" :height="384" />
    </div>
    <div class="row g-3 scientific-lang-panel d-none" data-lang-panel="en">
        <x-admin.summernote-field name="details_en" label="Ilmiy faoliyat (EN)" :value="old('details_en', $scientific?->details_en)" :rows="6" :height="384" />
    </div>

    <div class="row g-3 mt-1">
        <div class="col-md-6">
            <label class="form-label">Holati *</label>
            <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">
                <option value="1" @selected(old('is_active', $scientific ? ($scientific->is_active ? '1' : '0') : '1') == '1')>Aktiv</option>
                <option value="0" @selected(old('is_active', $scientific ? ($scientific->is_active ? '1' : '0') : '1') == '0')>Nofaol</option>
            </select>
            @error('is_active') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-end">
        <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2">
            <i data-feather="save" class="w-4 h-4"></i>
            <span>{{ $scientific ? 'Yangilash' : 'Saqlash' }}</span>
        </button>
    </div>
</form>

<x-admin.summernote-lang-tabs-script tabs-selector="#scientific-lang-tabs [data-lang]" panels-selector=".scientific-lang-panel" />
