@php
    $collaboration = $laboratory->internationalCollaboration;
    $formAction = $collaboration
        ? route('admin.laboratories.international-collaborations.update', [$laboratory, $collaboration])
        : route('admin.laboratories.international-collaborations.store', $laboratory);
@endphp

<div class="mb-4">
    <h5 class="fw-semibold mb-1">Xalqaro hamkorlik</h5>
    <p class="text-body-tertiary mb-0 fs-9">Xalqaro hamkorliklar haqida matn</p>
</div>

<form action="{{ $formAction }}" method="POST">
    @csrf
    @if ($collaboration)
        @method('PUT')
    @endif

    <ul class="nav nav-underline mb-3" id="international-lang-tabs">
        <li class="nav-item col text-center">
            <button type="button" class="nav-link international-lang-tab-btn active fw-semibold w-100 border-0 bg-transparent" data-lang="uz">O'zbekcha</button>
        </li>
        <li class="nav-item col text-center">
            <button type="button" class="nav-link international-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent" data-lang="ru">Ruscha</button>
        </li>
        <li class="nav-item col text-center">
            <button type="button" class="nav-link international-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent" data-lang="en">English</button>
        </li>
    </ul>

    <div class="row g-3 international-lang-panel" data-lang-panel="uz">
        <x-admin.summernote-field name="details_uz" label="Xalqaro hamkorlik (UZ)" :value="old('details_uz', $collaboration?->details_uz)" :rows="8" :height="480" />
    </div>
    <div class="row g-3 international-lang-panel d-none" data-lang-panel="ru">
        <x-admin.summernote-field name="details_ru" label="Xalqaro hamkorlik (RU)" :value="old('details_ru', $collaboration?->details_ru)" :rows="6" :height="384" />
    </div>
    <div class="row g-3 international-lang-panel d-none" data-lang-panel="en">
        <x-admin.summernote-field name="details_en" label="Xalqaro hamkorlik (EN)" :value="old('details_en', $collaboration?->details_en)" :rows="6" :height="384" />
    </div>

    <div class="row g-3 mt-1">
        <div class="col-md-6">
            <label class="form-label">Holati *</label>
            <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">
                <option value="1" @selected(old('is_active', $collaboration ? ($collaboration->is_active ? '1' : '0') : '1') == '1')>Aktiv</option>
                <option value="0" @selected(old('is_active', $collaboration ? ($collaboration->is_active ? '1' : '0') : '1') == '0')>Nofaol</option>
            </select>
            @error('is_active') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-end">
        <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2">
            <i data-feather="save" class="w-4 h-4"></i>
            <span>{{ $collaboration ? 'Yangilash' : 'Saqlash' }}</span>
        </button>
    </div>
</form>

<x-admin.summernote-lang-tabs-script tabs-selector="#international-lang-tabs [data-lang]" panels-selector=".international-lang-panel" />
