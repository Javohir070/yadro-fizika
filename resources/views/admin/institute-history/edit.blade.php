@extends('layouts.admin')

@section('content')
    <style>
        #institute-history-lang-tabs-edit .institute-history-lang-tab-btn {
            border-bottom: 2px solid transparent !important;
            border-radius: 0;
        }

        #institute-history-lang-tabs-edit .institute-history-lang-tab-btn.active {
            border-bottom-color: #f4a259 !important;
        }
    </style>

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0">Institut tarixi — tahrirlash</h3>
        <a href="{{ route('admin.institute-histories.index') }}" class="btn btn-secondary">Orqaga</a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('admin.institute-histories.update', $instituteHistory) }}" method="POST">
                @csrf
                @method('PUT')

                <ul class="nav nav-underline mb-3" id="institute-history-lang-tabs-edit">
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link institute-history-lang-tab-btn active fw-semibold w-100 border-0 bg-transparent"
                            data-lang="uz">O'zbekcha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link institute-history-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="ru">Ruscha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link institute-history-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="en">English</button>
                    </li>
                </ul>

                <div class="row g-3 institute-history-lang-panel-edit" data-lang-panel="uz">
                    <x-admin.summernote-field name="details_uz" label="Tafsilot (UZ)" :value="$instituteHistory->details_uz"
                        :rows="8" :height="480" />
                </div>

                <div class="row g-3 institute-history-lang-panel-edit d-none" data-lang-panel="ru">
                    <x-admin.summernote-field name="details_ru" label="Tafsilot (RU)" :value="$instituteHistory->details_ru"
                        :rows="6" :height="384" />
                </div>

                <div class="row g-3 institute-history-lang-panel-edit d-none" data-lang-panel="en">
                    <x-admin.summernote-field name="details_en" label="Tafsilot (EN)" :value="$instituteHistory->details_en"
                        :rows="6" :height="384" />
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-12">
                        <label class="form-label">Holati *</label>
                        <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">
                            <option value="1" @selected(old('is_active', $instituteHistory->is_active ? '1' : '0') == '1')>Aktiv</option>
                            <option value="0" @selected(old('is_active', $instituteHistory->is_active ? '1' : '0') == '0')>Nofaol</option>
                        </select>
                        @error('is_active')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2 justify-content-end">
                    <button type="submit" class="btn btn-primary">Yangilash</button>
                    <a href="{{ route('admin.institute-histories.show', $instituteHistory) }}"
                        class="btn btn-outline-info">Ko'rish</a>
                    <a href="{{ route('admin.institute-histories.index') }}" class="btn btn-outline-secondary">Bekor qilish</a>
                </div>
            </form>
        </div>
    </div>

    <x-admin.summernote-lang-tabs-script tabs-selector="#institute-history-lang-tabs-edit [data-lang]"
        panels-selector=".institute-history-lang-panel-edit" />
@endsection
