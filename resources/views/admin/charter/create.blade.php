@extends('layouts.admin')

@section('content')
    <style>
        #charter-lang-tabs-create .charter-lang-tab-btn {
            border-bottom: 2px solid transparent !important;
            border-radius: 0;
        }

        #charter-lang-tabs-create .charter-lang-tab-btn.active {
            border-bottom-color: #f4a259 !important;
        }
    </style>

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0">Institut nizomi — yaratish</h3>
        <a href="{{ route('admin.charters.index') }}" class="btn btn-secondary">Orqaga</a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('admin.charters.store') }}" method="POST">
                @csrf

                <ul class="nav nav-underline mb-3" id="charter-lang-tabs-create">
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link charter-lang-tab-btn active fw-semibold w-100 border-0 bg-transparent"
                            data-lang="uz">O'zbekcha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link charter-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="ru">Ruscha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link charter-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="en">English</button>
                    </li>
                </ul>

                <div class="row g-3 charter-lang-panel" data-lang-panel="uz">
                    <x-admin.summernote-field name="details_uz" label="Tafsilot (UZ)" :rows="8" :height="480" />
                </div>

                <div class="row g-3 charter-lang-panel d-none" data-lang-panel="ru">
                    <x-admin.summernote-field name="details_ru" label="Tafsilot (RU)" :rows="6" :height="384" />
                </div>

                <div class="row g-3 charter-lang-panel d-none" data-lang-panel="en">
                    <x-admin.summernote-field name="details_en" label="Tafsilot (EN)" :rows="6" :height="384" />
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-12">
                        <label class="form-label">Holati *</label>
                        <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">
                            <option value="1" @selected(old('is_active', '1') == '1')>Aktiv</option>
                            <option value="0" @selected(old('is_active') == '0')>Nofaol</option>
                        </select>
                        @error('is_active')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2 justify-content-end">
                    <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2">
                        <i data-feather="save" class="w-4 h-4"></i>
                        <span>Saqlash</span>
                    </button>
                    <a href="{{ route('admin.charters.index') }}" class="btn btn-outline-secondary">Bekor qilish</a>
                </div>
            </form>
        </div>
    </div>

    <x-admin.summernote-lang-tabs-script tabs-selector="#charter-lang-tabs-create [data-lang]"
        panels-selector=".charter-lang-panel" />
@endsection
