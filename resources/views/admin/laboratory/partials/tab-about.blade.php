<div class="mb-4">
    <h5 class="fw-semibold mb-1">Laboratoriya haqida</h5>
    <p class="text-body-tertiary mb-0 fs-9">Nomi, tarixi va asosiy sozlamalar</p>
</div>

<form action="{{ route('admin.laboratories.update', $laboratory) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <ul class="nav nav-underline mb-3" id="laboratory-lang-tabs-edit">
        <li class="nav-item col text-center">
            <button type="button"
                class="nav-link laboratory-lang-tab-btn active fw-semibold w-100 border-0 bg-transparent"
                data-lang="uz">O'zbekcha</button>
        </li>
        <li class="nav-item col text-center">
            <button type="button"
                class="nav-link laboratory-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                data-lang="ru">Ruscha</button>
        </li>
        <li class="nav-item col text-center">
            <button type="button"
                class="nav-link laboratory-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                data-lang="en">English</button>
        </li>
    </ul>

    <div class="row g-3 laboratory-lang-panel-edit" data-lang-panel="uz">
        <div class="col-md-12">
            <label class="form-label">Nomi (UZ) *</label>
            <input type="text" name="name_uz" value="{{ old('name_uz', $laboratory->name_uz) }}"
                class="form-control @error('name_uz') is-invalid @enderror">
            @error('name_uz') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <x-admin.summernote-field name="details_uz" label="Laboratoriya tarixi / tafsilot (UZ)" :value="$laboratory->details_uz"
            :rows="8" :height="480" />
    </div>

    <div class="row g-3 laboratory-lang-panel-edit d-none" data-lang-panel="ru">
        <div class="col-md-12">
            <label class="form-label">Nomi (RU) *</label>
            <input type="text" name="name_ru" value="{{ old('name_ru', $laboratory->name_ru) }}"
                class="form-control @error('name_ru') is-invalid @enderror">
            @error('name_ru') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <x-admin.summernote-field name="details_ru" label="Laboratoriya tarixi / tafsilot (RU)" :value="$laboratory->details_ru"
            :rows="6" :height="384" />
    </div>

    <div class="row g-3 laboratory-lang-panel-edit d-none" data-lang-panel="en">
        <div class="col-md-12">
            <label class="form-label">Nomi (EN) *</label>
            <input type="text" name="name_en" value="{{ old('name_en', $laboratory->name_en) }}"
                class="form-control @error('name_en') is-invalid @enderror">
            @error('name_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <x-admin.summernote-field name="details_en" label="Laboratoriya tarixi / tafsilot (EN)" :value="$laboratory->details_en"
            :rows="6" :height="384" />
    </div>

    <div class="row g-3 mt-1">
        @include('admin.components.image-upload-fields', ['model' => $laboratory])
        <div class="col-md-6">
            <label class="form-label">Tartib *</label>
            <input type="number" min="0" name="order" value="{{ old('order', $laboratory->order) }}"
                class="form-control @error('order') is-invalid @enderror">
            @error('order') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Holati *</label>
            <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">
                <option value="1" @selected(old('is_active', $laboratory->is_active ? '1' : '0') == '1')>Aktiv</option>
                <option value="0" @selected(old('is_active', $laboratory->is_active ? '1' : '0') == '0')>Nofaol</option>
            </select>
            @error('is_active') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="mt-4 d-flex gap-2 justify-content-end">
        <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2">
            <i data-feather="save" class="w-4 h-4"></i>
            <span>Saqlash</span>
        </button>
    </div>
</form>

<x-admin.summernote-lang-tabs-script tabs-selector="#laboratory-lang-tabs-edit [data-lang]"
    panels-selector=".laboratory-lang-panel-edit" />
