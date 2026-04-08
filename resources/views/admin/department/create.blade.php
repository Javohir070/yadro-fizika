@extends('layouts.admin')

@section('content')
    <style>
        #department-lang-tabs-create .department-lang-tab-btn {
            border-bottom: 2px solid transparent !important;
            border-radius: 0;
        }

        #department-lang-tabs-create .department-lang-tab-btn.active {
            border-bottom-color: #f4a259 !important;
        }
    </style>

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0">Bo'lim yaratish</h3>
        <a href="{{ route('admin.departments.index') }}" class="btn btn-secondary">Orqaga</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.departments.store') }}" method="POST">
                @csrf

                <ul class="nav nav-underline mb-3" id="department-lang-tabs-create">
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link department-lang-tab-btn active fw-semibold w-100 border-0 bg-transparent"
                            data-lang="uz">O'zbekcha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link department-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="ru">Ruscha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link department-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="en">English</button>
                    </li>
                </ul>

                <div class="row g-3 department-lang-panel" data-lang-panel="uz">
                    <div class="col-md-12">
                        <label class="form-label">Nomi (UZ) *</label>
                        <input type="text" name="name_uz" value="{{ old('name_uz') }}"
                            class="form-control @error('name_uz') is-invalid @enderror">
                        @error('name_uz')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row g-3 department-lang-panel d-none" data-lang-panel="ru">
                    <div class="col-md-12">
                        <label class="form-label">Nomi (RU) *</label>
                        <input type="text" name="name_ru" value="{{ old('name_ru') }}"
                            class="form-control @error('name_ru') is-invalid @enderror">
                        @error('name_ru')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row g-3 department-lang-panel d-none" data-lang-panel="en">
                    <div class="col-md-12">
                        <label class="form-label">Nomi (EN) *</label>
                        <input type="text" name="name_en" value="{{ old('name_en') }}"
                            class="form-control @error('name_en') is-invalid @enderror">
                        @error('name_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-12">
                        <label class="form-label">Turi *</label>
                        <select name="type" class="form-select @error('type') is-invalid @enderror">
                            @foreach (\App\Enums\DepartmentType::cases() as $type)
                                <option value="{{ $type->value }}" {{ old('type') === $type->value ? 'selected' : '' }}>
                                    {{ $type->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-12">
                        <label class="form-label">Holati *</label>
                        <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">
                            <option value="1">Aktiv</option>
                            <option value="0">Nofaol</option>
                        </select>
                        @error('is_active')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Saqlash</button>
                    <a href="{{ route('admin.departments.index') }}" class="btn btn-outline-secondary">Bekor qilish</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function() {
            const tabs = document.querySelectorAll('#department-lang-tabs-create [data-lang]');
            const panels = document.querySelectorAll('.department-lang-panel');

            function activateLang(lang) {
                tabs.forEach((tab) => {
                    const isActive = tab.dataset.lang === lang;
                    tab.classList.toggle('active', isActive);
                    tab.classList.toggle('text-body-tertiary', !isActive);
                });

                panels.forEach((panel) => {
                    panel.classList.toggle('d-none', panel.dataset.langPanel !== lang);
                });
            }

            tabs.forEach((tab) => {
                tab.addEventListener('click', function() {
                    activateLang(this.dataset.lang);
                });
            });

            activateLang('uz');
        })();
    </script>
@endsection
