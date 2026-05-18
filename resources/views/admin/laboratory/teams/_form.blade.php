@php
    $member = $team ?? null;
    $langTabsId = $member ? 'team-lang-tabs-edit' : 'team-lang-tabs-create';
@endphp

<ul class="nav nav-underline mb-3" id="{{ $langTabsId }}">
    <li class="nav-item col text-center">
        <button type="button" class="nav-link team-lang-tab-btn active fw-semibold w-100 border-0 bg-transparent" data-lang="uz">O'zbekcha</button>
    </li>
    <li class="nav-item col text-center">
        <button type="button" class="nav-link team-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent" data-lang="ru">Ruscha</button>
    </li>
    <li class="nav-item col text-center">
        <button type="button" class="nav-link team-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent" data-lang="en">English</button>
    </li>
</ul>

<div class="row g-3 team-lang-panel" data-lang-panel="uz">
    <div class="col-md-12">
        <label class="form-label">F.I.Sh (UZ) *</label>
        <input type="text" name="full_name_uz" value="{{ old('full_name_uz', $member?->full_name_uz) }}"
            class="form-control @error('full_name_uz') is-invalid @enderror">
        @error('full_name_uz') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Lavozim (UZ) *</label>
        <input type="text" name="position_uz" value="{{ old('position_uz', $member?->position_uz) }}"
            class="form-control @error('position_uz') is-invalid @enderror">
        @error('position_uz') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Ilmiy daraja / unvon (UZ)</label>
        <textarea name="degree_uz" rows="2" class="form-control @error('degree_uz') is-invalid @enderror">{{ old('degree_uz', $member?->degree_uz) }}</textarea>
        @error('degree_uz') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row g-3 team-lang-panel d-none" data-lang-panel="ru">
    <div class="col-md-12">
        <label class="form-label">F.I.Sh (RU) *</label>
        <input type="text" name="full_name_ru" value="{{ old('full_name_ru', $member?->full_name_ru) }}"
            class="form-control @error('full_name_ru') is-invalid @enderror">
        @error('full_name_ru') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Lavozim (RU) *</label>
        <input type="text" name="position_ru" value="{{ old('position_ru', $member?->position_ru) }}"
            class="form-control @error('position_ru') is-invalid @enderror">
        @error('position_ru') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Ilmiy daraja / unvon (RU)</label>
        <textarea name="degree_ru" rows="2" class="form-control @error('degree_ru') is-invalid @enderror">{{ old('degree_ru', $member?->degree_ru) }}</textarea>
        @error('degree_ru') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row g-3 team-lang-panel d-none" data-lang-panel="en">
    <div class="col-md-12">
        <label class="form-label">F.I.Sh (EN) *</label>
        <input type="text" name="full_name_en" value="{{ old('full_name_en', $member?->full_name_en) }}"
            class="form-control @error('full_name_en') is-invalid @enderror">
        @error('full_name_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Lavozim (EN) *</label>
        <input type="text" name="position_en" value="{{ old('position_en', $member?->position_en) }}"
            class="form-control @error('position_en') is-invalid @enderror">
        @error('position_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Ilmiy daraja / unvon (EN)</label>
        <textarea name="degree_en" rows="2" class="form-control @error('degree_en') is-invalid @enderror">{{ old('degree_en', $member?->degree_en) }}</textarea>
        @error('degree_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<hr class="my-4">

<h6 class="fw-semibold mb-3">Rasm va tartib</h6>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Rasm {{ $member ? '' : '*' }}</label>
        <input type="file" name="image" accept="image/*"
            class="form-control @error('image') is-invalid @enderror" {{ $member ? '' : 'required' }}>
        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
        <div class="form-text">JPG, PNG yoki WEBP (maks. 4 MB)</div>
        @if ($member?->image_url)
            <div class="mt-3 p-2 rounded border bg-body-secondary">
                <div class="text-body-tertiary fs-9 mb-2">Joriy rasm</div>
                <img src="{{ $member->image_url }}" alt="{{ $member->full_name_uz }}"
                    class="rounded border" style="max-height: 160px; object-fit: cover;">
            </div>
        @endif
    </div>
    <div class="col-md-3">
        <label class="form-label">Tartib *</label>
        <input type="number" min="0" name="order" value="{{ old('order', $member?->order ?? 0) }}"
            class="form-control @error('order') is-invalid @enderror">
        @error('order') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-3">
        <label class="form-label">Holati *</label>
        <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">
            <option value="1" @selected(old('is_active', ($member?->is_active ?? true) ? '1' : '0') == '1')>Aktiv</option>
            <option value="0" @selected(old('is_active', ($member?->is_active ?? true) ? '1' : '0') == '0')>Nofaol</option>
        </select>
        @error('is_active') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<hr class="my-4">

<h6 class="fw-semibold mb-3">Ilmiy profillar (ixtiyoriy)</h6>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Google Scholar</label>
        <input type="url" name="google_scholar" value="{{ old('google_scholar', $member?->google_scholar) }}"
            class="form-control @error('google_scholar') is-invalid @enderror" placeholder="https://">
        @error('google_scholar') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Web of Science</label>
        <input type="url" name="web_of_science" value="{{ old('web_of_science', $member?->web_of_science) }}"
            class="form-control @error('web_of_science') is-invalid @enderror" placeholder="https://">
        @error('web_of_science') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Scopus</label>
        <input type="url" name="scopus" value="{{ old('scopus', $member?->scopus) }}"
            class="form-control @error('scopus') is-invalid @enderror" placeholder="https://">
        @error('scopus') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">ResearchGate</label>
        <input type="url" name="researchgate" value="{{ old('researchgate', $member?->researchgate) }}"
            class="form-control @error('researchgate') is-invalid @enderror" placeholder="https://">
        @error('researchgate') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">ORCID</label>
        <input type="url" name="orcid" value="{{ old('orcid', $member?->orcid) }}"
            class="form-control @error('orcid') is-invalid @enderror" placeholder="https://">
        @error('orcid') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<x-admin.lang-tabs-script :tabs-selector="'#' . $langTabsId . ' [data-lang]'" panels-selector=".team-lang-panel" />
