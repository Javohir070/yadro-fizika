@php
    $activity = $workActivity ?? null;
    $langTabsId = $activity ? 'work-activity-lang-tabs-edit' : 'work-activity-lang-tabs-create';
@endphp

<ul class="nav nav-underline mb-3" id="{{ $langTabsId }}">
    <li class="nav-item col text-center">
        <button type="button" class="nav-link work-activity-lang-tab-btn active fw-semibold w-100 border-0 bg-transparent" data-lang="uz">O'zbekcha</button>
    </li>
    <li class="nav-item col text-center">
        <button type="button" class="nav-link work-activity-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent" data-lang="ru">Ruscha</button>
    </li>
    <li class="nav-item col text-center">
        <button type="button" class="nav-link work-activity-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent" data-lang="en">English</button>
    </li>
</ul>

<div class="row g-3 work-activity-lang-panel" data-lang-panel="uz">
    <x-admin.summernote-field name="details_uz" label="Mehnat faoliyati (UZ)" :value="old('details_uz', $activity?->details_uz)" :rows="8" :height="480" />
</div>

<div class="row g-3 work-activity-lang-panel d-none" data-lang-panel="ru">
    <x-admin.summernote-field name="details_ru" label="Mehnat faoliyati (RU)" :value="old('details_ru', $activity?->details_ru)" :rows="6" :height="384" />
</div>

<div class="row g-3 work-activity-lang-panel d-none" data-lang-panel="en">
    <x-admin.summernote-field name="details_en" label="Mehnat faoliyati (EN)" :value="old('details_en', $activity?->details_en)" :rows="6" :height="384" />
</div>

<div class="row g-3 mt-1">
    <div class="col-md-6">
        <label class="form-label">Holati *</label>
        <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">
            <option value="1" @selected(old('is_active', $activity ? ($activity->is_active ? '1' : '0') : '1') == '1')>Aktiv</option>
            <option value="0" @selected(old('is_active', $activity ? ($activity->is_active ? '1' : '0') : '1') == '0')>Nofaol</option>
        </select>
        @error('is_active') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<x-admin.summernote-lang-tabs-script tabs-selector="#{{ $langTabsId }} [data-lang]" panels-selector=".work-activity-lang-panel" />
