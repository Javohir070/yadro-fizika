@extends('layouts.admin')

@section('content')
    <style>
        #gallery-lang-tabs-edit .gallery-lang-tab-btn {
            border-bottom: 2px solid transparent !important;
            border-radius: 0;
        }

        #gallery-lang-tabs-edit .gallery-lang-tab-btn.active {
            border-bottom-color: #f4a259 !important;
        }
    </style>

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0">Galereya tahrirlash</h3>
        <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Orqaga</a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <ul class="nav nav-underline mb-3" id="gallery-lang-tabs-edit">
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link gallery-lang-tab-btn active fw-semibold w-100 border-0 bg-transparent"
                            data-lang="uz">O'zbekcha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link gallery-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="ru">Ruscha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link gallery-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="en">English</button>
                    </li>
                </ul>

                <div class="row g-3 gallery-lang-panel" data-lang-panel="uz">
                    <div class="col-md-12">
                        <label class="form-label">Sarlavha (UZ) *</label>
                        <input type="text" name="title_uz" value="{{ old('title_uz', $gallery->title_uz) }}"
                            class="form-control @error('title_uz') is-invalid @enderror">
                        @error('title_uz') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 gallery-lang-panel d-none" data-lang-panel="ru">
                    <div class="col-md-12">
                        <label class="form-label">Sarlavha (RU) *</label>
                        <input type="text" name="title_ru" value="{{ old('title_ru', $gallery->title_ru) }}"
                            class="form-control @error('title_ru') is-invalid @enderror">
                        @error('title_ru') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 gallery-lang-panel d-none" data-lang-panel="en">
                    <div class="col-md-12">
                        <label class="form-label">Sarlavha (EN) *</label>
                        <input type="text" name="title_en" value="{{ old('title_en', $gallery->title_en) }}"
                            class="form-control @error('title_en') is-invalid @enderror">
                        @error('title_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-12">
                        <label class="form-label">Asosiy rasm</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                            accept=".jpg,.jpeg,.png,.webp">
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Qo'shimcha rasmlar qo'shish</label>
                        <input type="file" name="images[]" multiple
                            class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
                            accept=".jpg,.jpeg,.png,.webp">
                        @error('images') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        @error('images.*') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Holati *</label>
                        <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">
                            <option value="1" {{ old('is_active', $gallery->is_active) == 1 ? 'selected' : '' }}>Aktiv</option>
                            <option value="0" {{ old('is_active', $gallery->is_active) == 0 ? 'selected' : '' }}>Nofaol</option>
                        </select>
                        @error('is_active') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Asosiy rasm</label>
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title_uz }}"
                            style="width: 240px; height: 140px; object-fit: cover;" class="rounded border">
                    </div>

                    @if ($gallery->images->isNotEmpty())
                        <div class="col-md-12">
                            <label class="form-label">Qo'shimcha rasmlar</label>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($gallery->images as $image)
                                    <img src="{{ asset('storage/' . $image->image) }}" alt="Gallery image"
                                        style="width: 90px; height: 60px; object-fit: cover;" class="rounded border">
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="mt-4 d-flex gap-2 justify-content-end">
                    <button type="submit" class="btn btn-primary">Yangilash</button>
                    <a href="{{ route('admin.galleries.show', $gallery) }}" class="btn btn-outline-info">Ko'rish</a>
                    <a href="{{ route('admin.galleries.index') }}" class="btn btn-outline-secondary">Bekor qilish</a>
                </div>
            </form>
        </div>
    </div>

    <x-admin.summernote-lang-tabs-script tabs-selector="#gallery-lang-tabs-edit [data-lang]"
        panels-selector=".gallery-lang-panel" />
@endsection
