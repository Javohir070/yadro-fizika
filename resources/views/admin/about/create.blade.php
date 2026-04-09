@extends('layouts.admin')

@section('content')
    <style>
        #about-lang-tabs-create .about-lang-tab-btn {
            border-bottom: 2px solid transparent !important;
            border-radius: 0;
        }

        #about-lang-tabs-create .about-lang-tab-btn.active {
            border-bottom-color: #f4a259 !important;
        }
    </style>

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0">About yaratish</h3>
        <a href="{{ route('admin.abouts.index') }}" class="btn btn-secondary">Orqaga</a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('admin.abouts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <ul class="nav nav-underline mb-3" id="about-lang-tabs-create">
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link about-lang-tab-btn active fw-semibold w-100 border-0 bg-transparent"
                            data-lang="uz">O'zbekcha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link about-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="ru">Ruscha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link about-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="en">English</button>
                    </li>
                </ul>

                <div class="row g-3 about-lang-panel" data-lang-panel="uz">
                    <div class="col-md-12">
                        <label class="form-label">Content (UZ) *</label>
                        <textarea name="content_uz" rows="8" data-tinymce='{"height":"30rem"}'
                            class="form-control @error('content_uz') is-invalid @enderror">{{ old('content_uz') }}</textarea>
                        @error('content_uz')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="row g-3 about-lang-panel d-none" data-lang-panel="ru">
                    <div class="col-md-12">
                        <label class="form-label">Content (RU) *</label>
                        <textarea name="content_ru" rows="6" data-tinymce='{"height":"24rem"}'
                            class="form-control @error('content_ru') is-invalid @enderror">{{ old('content_ru') }}</textarea>
                        @error('content_ru')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="row g-3 about-lang-panel d-none" data-lang-panel="en">
                    <div class="col-md-12">
                        <label class="form-label">Content (EN) *</label>
                        <textarea name="content_en" rows="6" data-tinymce='{"height":"24rem"}'
                            class="form-control @error('content_en') is-invalid @enderror">{{ old('content_en') }}</textarea>
                        @error('content_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-12">
                        <label class="form-label">Rasm</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                        @error('image')
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

                <div class="mt-4 d-flex gap-2 justify-content-end">
                    <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2">
                            <i data-feather="save" class="w-4 h-4"></i>
                            <span>Saqlash</span>
                        </button>
                    <a href="{{ route('admin.abouts.index') }}" class="btn btn-outline-secondary">Bekor qilish</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function() {
            const tabs = document.querySelectorAll('#about-lang-tabs-create [data-lang]');
            const panels = document.querySelectorAll('.about-lang-panel');

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
