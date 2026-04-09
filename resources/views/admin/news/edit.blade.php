@extends('layouts.admin')

@section('content')
    <style>
        #news-lang-tabs-edit .news-lang-tab-btn {
            border-bottom: 2px solid transparent !important;
            border-radius: 0;
        }

        #news-lang-tabs-edit .news-lang-tab-btn.active {
            border-bottom-color: #f4a259 !important;
        }
    </style>

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0">Yangilik tahrirlash</h3>
        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Orqaga</a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <ul class="nav nav-underline mb-3" id="news-lang-tabs-edit">
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link news-lang-tab-btn active fw-semibold w-100 border-0 bg-transparent"
                            data-lang="uz">O'zbekcha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link news-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="ru">Ruscha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link news-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="en">English</button>
                    </li>
                </ul>

                <div class="row g-3 news-lang-panel-edit" data-lang-panel="uz">
                    <div class="col-md-12">
                        <label class="form-label">Sarlavha (UZ) *</label>
                        <input type="text" name="title_uz" value="{{ old('title_uz', $news->title_uz) }}"
                            class="form-control @error('title_uz') is-invalid @enderror">
                        @error('title_uz') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Tavsif (UZ) *</label>
                        <textarea name="description_uz" rows="8" data-tinymce='{"height":"26rem"}'
                            class="form-control @error('description_uz') is-invalid @enderror">{{ old('description_uz', $news->description_uz) }}</textarea>
                        @error('description_uz') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 news-lang-panel-edit d-none" data-lang-panel="ru">
                    <div class="col-md-12">
                        <label class="form-label">Sarlavha (RU) *</label>
                        <input type="text" name="title_ru" value="{{ old('title_ru', $news->title_ru) }}"
                            class="form-control @error('title_ru') is-invalid @enderror">
                        @error('title_ru') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Tavsif (RU) *</label>
                        <textarea name="description_ru" rows="8" data-tinymce='{"height":"26rem"}'
                            class="form-control @error('description_ru') is-invalid @enderror">{{ old('description_ru', $news->description_ru) }}</textarea>
                        @error('description_ru') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 news-lang-panel-edit d-none" data-lang-panel="en">
                    <div class="col-md-12">
                        <label class="form-label">Sarlavha (EN) *</label>
                        <input type="text" name="title_en" value="{{ old('title_en', $news->title_en) }}"
                            class="form-control @error('title_en') is-invalid @enderror">
                        @error('title_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Tavsif (EN) *</label>
                        <textarea name="description_en" rows="8" data-tinymce='{"height":"26rem"}'
                            class="form-control @error('description_en') is-invalid @enderror">{{ old('description_en', $news->description_en) }}</textarea>
                        @error('description_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-12">
                        <label class="form-label">Yangi rasmlar qo'shish</label>
                        <input type="file" name="images[]" multiple
                            class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
                            accept=".jpg,.jpeg,.png,.webp">
                        @error('images') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        @error('images.*') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    @if ($news->images()->count() > 0)
                        <div class="col-md-12">
                            <label class="form-label">Mavjud rasmlar</label>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($news->images as $image)
                                    <img src="{{ asset('storage/' . $image->image) }}" alt="News image"
                                        style="width: 90px; height: 60px; object-fit: cover;" class="rounded border">
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="col-md-12">
                        <label class="form-label">Holati *</label>
                        <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">
                            <option value="1" {{ old('is_active', $news->is_active) == 1 ? 'selected' : '' }}>Aktiv</option>
                            <option value="0" {{ old('is_active', $news->is_active) == 0 ? 'selected' : '' }}>Nofaol</option>
                        </select>
                        @error('is_active') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2 justify-content-end">
                    <button type="submit" class="btn btn-primary">Yangilash</button>
                    <a href="{{ route('admin.news.show', $news) }}" class="btn btn-outline-info">Ko'rish</a>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary">Bekor qilish</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function() {
            const tabs = document.querySelectorAll('#news-lang-tabs-edit [data-lang]');
            const panels = document.querySelectorAll('.news-lang-panel-edit');

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
