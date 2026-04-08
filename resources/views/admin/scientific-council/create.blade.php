@extends('layouts.admin')

@section('content')
    <style>
        #scientific-council-lang-tabs-create .scientific-council-lang-tab-btn {
            border-bottom: 2px solid transparent !important;
            border-radius: 0;
        }

        #scientific-council-lang-tabs-create .scientific-council-lang-tab-btn.active {
            border-bottom-color: #f4a259 !important;
        }
    </style>

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0">Ilmiy kengash — yaratish</h3>
        <a href="{{ route('admin.scientific-councils.index') }}" class="btn btn-secondary">Orqaga</a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('admin.scientific-councils.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <ul class="nav nav-underline mb-3" id="scientific-council-lang-tabs-create">
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link scientific-council-lang-tab-btn active fw-semibold w-100 border-0 bg-transparent"
                            data-lang="uz">O'zbekcha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link scientific-council-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="ru">Ruscha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link scientific-council-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="en">English</button>
                    </li>
                </ul>

                <div class="row g-3 scientific-council-lang-panel" data-lang-panel="uz">
                    <div class="col-md-12">
                        <label class="form-label">Sarlavha (UZ) *</label>
                        <input type="text" name="title_uz" value="{{ old('title_uz') }}"
                            class="form-control @error('title_uz') is-invalid @enderror">
                        @error('title_uz') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Kengash vazifalari (UZ) *</label>
                        <textarea name="council_duties_uz" rows="6" data-tinymce='{"height":"22rem"}'
                            class="form-control @error('council_duties_uz') is-invalid @enderror">{{ old('council_duties_uz') }}</textarea>
                        @error('council_duties_uz') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 scientific-council-lang-panel d-none" data-lang-panel="ru">
                    <div class="col-md-12">
                        <label class="form-label">Sarlavha (RU) *</label>
                        <input type="text" name="title_ru" value="{{ old('title_ru') }}"
                            class="form-control @error('title_ru') is-invalid @enderror">
                        @error('title_ru') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Kengash vazifalari (RU) *</label>
                        <textarea name="council_duties_ru" rows="6" data-tinymce='{"height":"22rem"}'
                            class="form-control @error('council_duties_ru') is-invalid @enderror">{{ old('council_duties_ru') }}</textarea>
                        @error('council_duties_ru') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 scientific-council-lang-panel d-none" data-lang-panel="en">
                    <div class="col-md-12">
                        <label class="form-label">Sarlavha (EN) *</label>
                        <input type="text" name="title_en" value="{{ old('title_en') }}"
                            class="form-control @error('title_en') is-invalid @enderror">
                        @error('title_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Kengash vazifalari (EN) *</label>
                        <textarea name="council_duties_en" rows="6" data-tinymce='{"height":"22rem"}'
                            class="form-control @error('council_duties_en') is-invalid @enderror">{{ old('council_duties_en') }}</textarea>
                        @error('council_duties_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <label class="form-label">Rasm *</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" required>
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
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
                    <a href="{{ route('admin.scientific-councils.index') }}" class="btn btn-outline-secondary">Bekor qilish</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function() {
            const tabs = document.querySelectorAll('#scientific-council-lang-tabs-create [data-lang]');
            const panels = document.querySelectorAll('.scientific-council-lang-panel');

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
