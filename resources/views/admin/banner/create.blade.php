@extends('layouts.admin')

@section('content')
    <style>
        #banner-lang-tabs-create .banner-lang-tab-btn {
            border-bottom: 2px solid transparent !important;
            border-radius: 0;
        }

        #banner-lang-tabs-create .banner-lang-tab-btn.active {
            border-bottom-color: #f4a259 !important;
        }
    </style>

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0">Banner yaratish</h3>
        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Orqaga</a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <ul class="nav nav-underline mb-3" id="banner-lang-tabs-create">
                    <li class="nav-item col text-center">
                        <button type="button" class="nav-link banner-lang-tab-btn active fw-semibold w-100 border-0 bg-transparent"
                            data-lang="uz">O'zbekcha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button" class="nav-link banner-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="ru">Ruscha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button" class="nav-link banner-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="en">English</button>
                    </li>
                </ul>

                <div class="row g-3 mb-2 banner-lang-panel" data-lang-panel="uz">
                    <div class="col-lg-12">
                        <label class="form-label">Sarlavha (UZ) *</label>
                        <input type="text" name="title_uz" class="form-control @error('title_uz') is-invalid @enderror"
                            value="{{ old('title_uz') }}" placeholder="Yangilik sarlavhasini...">
                        @error('title_uz') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 mb-2 banner-lang-panel d-none" data-lang-panel="ru">
                    <div class="col-lg-12">
                        <label class="form-label">Sarlavha (RU) *</label>
                        <input type="text" name="title_ru" class="form-control @error('title_ru') is-invalid @enderror"
                            value="{{ old('title_ru') }}" placeholder="Заголовок новости...">
                        @error('title_ru') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 mb-2 banner-lang-panel d-none" data-lang-panel="en">
                    <div class="col-lg-12">
                        <label class="form-label">Sarlavha (EN) *</label>
                        <input type="text" name="title_en" class="form-control @error('title_en') is-invalid @enderror"
                            value="{{ old('title_en') }}" placeholder="News title...">
                        @error('title_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 mt-1 banner-lang-panel" data-lang-panel="uz">
                    <div class="col-md-12">
                        <label class="form-label">Qisqa ma'lumot (UZ) *</label>
                        <textarea name="description_uz" class="form-control @error('description_uz') is-invalid @enderror" rows="5"
                            placeholder="Qisqa tavsif...">{{ old('description_uz') }}</textarea>
                        @error('description_uz') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 mt-1 banner-lang-panel d-none" data-lang-panel="ru">
                    <div class="col-md-12">
                        <label class="form-label">To'liq ma'lumot (RU) *</label>
                        <textarea name="description_ru" class="form-control @error('description_ru') is-invalid @enderror" rows="6"
                            placeholder="Полное описание...">{{ old('description_ru') }}</textarea>
                        @error('description_ru') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 mt-1 banner-lang-panel d-none" data-lang-panel="en">
                    <div class="col-md-12">
                        <label class="form-label">To'liq ma'lumot (EN) *</label>
                        <textarea name="description_en" class="form-control @error('description_en') is-invalid @enderror" rows="6"
                            placeholder="Full description...">{{ old('description_en') }}</textarea>
                        @error('description_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-12">
                        <label class="form-label">Rasm manzili *</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                            placeholder="Rasmni tanlang...">
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-12">
                        <label class="form-label">Aktivligi *</label>
                        <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">
                            <option value="1">Aktiv</option>
                            <option value="0">Nofaol</option>
                        </select>
                        @error('is_active') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2 justify-content-end">
                    <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2">
                            <i data-feather="save" class="w-4 h-4"></i>
                            <span>Saqlash</span>
                        </button>
                    <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary">Bekor qilish</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function() {
            const tabs = document.querySelectorAll('#banner-lang-tabs-create [data-lang]');
            const panels = document.querySelectorAll('.banner-lang-panel');

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
