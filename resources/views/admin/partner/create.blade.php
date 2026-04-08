@extends('layouts.admin')

@section('content')
    <style>
        #partner-lang-tabs-create .partner-lang-tab-btn {
            border-bottom: 2px solid transparent !important;
            border-radius: 0;
        }

        #partner-lang-tabs-create .partner-lang-tab-btn.active {
            border-bottom-color: #f4a259 !important;
        }
    </style>

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0">Hamkor yaratish</h3>
        <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">Orqaga</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <ul class="nav nav-underline mb-3" id="partner-lang-tabs-create">
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link partner-lang-tab-btn active fw-semibold w-100 border-0 bg-transparent"
                            data-lang="uz">O'zbekcha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link partner-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="ru">Ruscha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link partner-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="en">English</button>
                    </li>
                </ul>

                <div class="row g-3 partner-lang-panel" data-lang-panel="uz">
                    <div class="col-md-12">
                        <label class="form-label">Nomi (UZ) *</label>
                        <input type="text" name="name_uz" value="{{ old('name_uz') }}"
                            class="form-control @error('name_uz') is-invalid @enderror">
                        @error('name_uz') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Tavsif (UZ) *</label>
                        <textarea name="description_uz" rows="4" maxlength="600"
                            class="form-control @error('description_uz') is-invalid @enderror">{{ old('description_uz') }}</textarea>
                        @error('description_uz') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 partner-lang-panel d-none" data-lang-panel="ru">
                    <div class="col-md-12">
                        <label class="form-label">Nomi (RU) *</label>
                        <input type="text" name="name_ru" value="{{ old('name_ru') }}"
                            class="form-control @error('name_ru') is-invalid @enderror">
                        @error('name_ru') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Tavsif (RU) *</label>
                        <textarea name="description_ru" rows="4" maxlength="600"
                            class="form-control @error('description_ru') is-invalid @enderror">{{ old('description_ru') }}</textarea>
                        @error('description_ru') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 partner-lang-panel d-none" data-lang-panel="en">
                    <div class="col-md-12">
                        <label class="form-label">Nomi (EN) *</label>
                        <input type="text" name="name_en" value="{{ old('name_en') }}"
                            class="form-control @error('name_en') is-invalid @enderror">
                        @error('name_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Tavsif (EN) *</label>
                        <textarea name="description_en" rows="4" maxlength="600"
                            class="form-control @error('description_en') is-invalid @enderror">{{ old('description_en') }}</textarea>
                        @error('description_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <label class="form-label">Rasm *</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" required>
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Havola *</label>
                        <input type="url" name="link" value="{{ old('link') }}"
                            class="form-control @error('link') is-invalid @enderror" placeholder="https://example.com">
                        @error('link') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Holati *</label>
                        <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">
                            <option value="1">Aktiv</option>
                            <option value="0">Nofaol</option>
                        </select>
                        @error('is_active') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Saqlash</button>
                    <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary">Bekor qilish</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function() {
            const tabs = document.querySelectorAll('#partner-lang-tabs-create [data-lang]');
            const panels = document.querySelectorAll('.partner-lang-panel');

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
