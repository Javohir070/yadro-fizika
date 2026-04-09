@extends('layouts.admin')

@section('content')
    <style>
        #video-galler-lang-tabs-create .video-galler-lang-tab-btn {
            border-bottom: 2px solid transparent !important;
            border-radius: 0;
        }

        #video-galler-lang-tabs-create .video-galler-lang-tab-btn.active {
            border-bottom-color: #f4a259 !important;
        }
    </style>

    @include('admin.components.navbar_top', ['maniUrl' => 'Video qo\'shish'])

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0">Video yaratish</h3>
        <a href="{{ route('admin.video-gallers.index') }}" class="btn btn-secondary">Orqaga</a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('admin.video-gallers.store') }}" method="POST">
                @csrf

                <ul class="nav nav-underline mb-3" id="video-galler-lang-tabs-create">
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link video-galler-lang-tab-btn active fw-semibold w-100 border-0 bg-transparent"
                            data-lang="uz">O'zbekcha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link video-galler-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="ru">Ruscha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link video-galler-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="en">English</button>
                    </li>
                </ul>

                <div class="row g-3 video-galler-lang-panel" data-lang-panel="uz">
                    <div class="col-lg-12">
                        <label class="form-label">Sarlavha (UZ) *</label>
                        <input type="text" name="title_uz" value="{{ old('title_uz') }}"
                            class="form-control @error('title_uz') is-invalid @enderror" required>
                        @error('title_uz') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-12">
                        <label class="form-label">Tavsif (UZ)</label>
                        <textarea name="description_uz" rows="3" class="form-control @error('description_uz') is-invalid @enderror">{{ old('description_uz') }}</textarea>
                        @error('description_uz') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 video-galler-lang-panel d-none" data-lang-panel="ru">
                    <div class="col-lg-12">
                        <label class="form-label">Sarlavha (RU) *</label>
                        <input type="text" name="title_ru" value="{{ old('title_ru') }}"
                            class="form-control @error('title_ru') is-invalid @enderror" required>
                        @error('title_ru') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-12">
                        <label class="form-label">Tavsif (RU)</label>
                        <textarea name="description_ru" rows="3" class="form-control @error('description_ru') is-invalid @enderror">{{ old('description_ru') }}</textarea>
                        @error('description_ru') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 video-galler-lang-panel d-none" data-lang-panel="en">
                    <div class="col-lg-12">
                        <label class="form-label">Sarlavha (EN) *</label>
                        <input type="text" name="title_en" value="{{ old('title_en') }}"
                            class="form-control @error('title_en') is-invalid @enderror" required>
                        @error('title_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-lg-12">
                        <label class="form-label">Tavsif (EN)</label>
                        <textarea name="description_en" rows="3" class="form-control @error('description_en') is-invalid @enderror">{{ old('description_en') }}</textarea>
                        @error('description_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-12">
                        <label class="form-label">Video URL *</label>
                        <input type="url" name="url" value="{{ old('url') }}"
                            class="form-control @error('url') is-invalid @enderror" required>
                        @error('url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tartib *</label>
                        <input type="number" min="0" name="order" value="{{ old('order', 0) }}"
                            class="form-control @error('order') is-invalid @enderror" required>
                        @error('order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Holati *</label>
                        <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">
                            <option value="1" @selected(old('is_active', '1') == '1')>Aktiv</option>
                            <option value="0" @selected(old('is_active') == '0')>Nofaol</option>
                        </select>
                        @error('is_active') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2 justify-content-end">
                    <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2">
                        <i data-feather="save" class="w-4 h-4"></i>
                        <span>Saqlash</span>
                    </button>
                    <a href="{{ route('admin.video-gallers.index') }}" class="btn btn-outline-secondary">Bekor qilish</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function() {
            const tabs = document.querySelectorAll('#video-galler-lang-tabs-create [data-lang]');
            const panels = document.querySelectorAll('.video-galler-lang-panel');

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
