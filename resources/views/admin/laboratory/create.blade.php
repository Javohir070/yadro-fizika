@extends('layouts.admin')

@section('content')
    <style>
        #laboratory-lang-tabs-create .laboratory-lang-tab-btn {
            border-bottom: 2px solid transparent !important;
            border-radius: 0;
        }

        #laboratory-lang-tabs-create .laboratory-lang-tab-btn.active {
            border-bottom-color: #f4a259 !important;
        }
    </style>

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0">Laboratoriya — yaratish</h3>
        <a href="{{ route('admin.laboratories.index') }}" class="btn btn-secondary">Orqaga</a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('admin.laboratories.store') }}" method="POST">
                @csrf

                <ul class="nav nav-underline mb-3" id="laboratory-lang-tabs-create">
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

                <div class="row g-3 laboratory-lang-panel" data-lang-panel="uz">
                    <div class="col-md-12">
                        <label class="form-label">Nomi (UZ) *</label>
                        <input type="text" name="name_uz" value="{{ old('name_uz') }}"
                            class="form-control @error('name_uz') is-invalid @enderror">
                        @error('name_uz')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <x-admin.summernote-field name="details_uz" label="Tafsilot (UZ)" :rows="8" :height="480" />
                </div>

                <div class="row g-3 laboratory-lang-panel d-none" data-lang-panel="ru">
                    <div class="col-md-12">
                        <label class="form-label">Nomi (RU) *</label>
                        <input type="text" name="name_ru" value="{{ old('name_ru') }}"
                            class="form-control @error('name_ru') is-invalid @enderror">
                        @error('name_ru')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <x-admin.summernote-field name="details_ru" label="Tafsilot (RU)" :rows="6" :height="384" />
                </div>

                <div class="row g-3 laboratory-lang-panel d-none" data-lang-panel="en">
                    <div class="col-md-12">
                        <label class="form-label">Nomi (EN) *</label>
                        <input type="text" name="name_en" value="{{ old('name_en') }}"
                            class="form-control @error('name_en') is-invalid @enderror">
                        @error('name_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <x-admin.summernote-field name="details_en" label="Tafsilot (EN)" :rows="6" :height="384" />
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-4">
                        <label class="form-label">Turi *</label>
                        <select name="type" class="form-select @error('type') is-invalid @enderror">
                            @foreach (\App\Enums\LaboratoryType::cases() as $type)
                                <option value="{{ $type->value }}" @selected(old('type', \App\Enums\LaboratoryType::Laboratory->value) === $type->value)>
                                    {{ $type->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tartib *</label>
                        <input type="number" min="0" name="order" value="{{ old('order', 0) }}"
                            class="form-control @error('order') is-invalid @enderror">
                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
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

                <p class="text-body-tertiary fs-9 mt-3 mb-0">Saqlagach, tarkib va boshqa bo'limlarni to'ldirish uchun boshqarish sahifasiga yo'naltiriladi.</p>

                <div class="mt-3 d-flex gap-2 justify-content-end">
                    <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2">
                        <i data-feather="save" class="w-4 h-4"></i>
                        <span>Saqlash</span>
                    </button>
                    <a href="{{ route('admin.laboratories.index') }}" class="btn btn-outline-secondary">Bekor qilish</a>
                </div>
            </form>
        </div>
    </div>

    <x-admin.summernote-lang-tabs-script tabs-selector="#laboratory-lang-tabs-create [data-lang]"
        panels-selector=".laboratory-lang-panel" />
@endsection
