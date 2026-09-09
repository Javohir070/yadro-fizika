@extends('layouts.admin')

@section('content')
    @include('admin.components.navbar_top', ['maniUrl' => 'Elon tahrirlash'])

    <style>
        #ad-lang-tabs-edit .ad-lang-tab-btn {
            border-bottom: 2px solid transparent !important;
            border-radius: 0;
        }

        #ad-lang-tabs-edit .ad-lang-tab-btn.active {
            border-bottom-color: #f4a259 !important;
        }
    </style>

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0">Elon bloki tahrirlash</h3>
        <a href="{{ route('admin.ads.index') }}" class="btn btn-secondary">Orqaga</a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.ads.update', $ad) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <ul class="nav nav-underline mb-3" id="ad-lang-tabs-edit">
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link ad-lang-tab-btn active fw-semibold w-100 border-0 bg-transparent"
                            data-lang="uz">O'zbekcha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link ad-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="ru">Ruscha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link ad-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="en">English</button>
                    </li>
                </ul>

                <div class="row g-3 ad-lang-panel" data-lang-panel="uz">
                    <div class="col-md-12">
                        <label class="form-label">Sarlavha (UZ) *</label>
                        <input type="text" name="title_uz" class="form-control @error('title_uz') is-invalid @enderror"
                            value="{{ old('title_uz', $ad->title_uz) }}">
                        @error('title_uz') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <x-admin.summernote-field name="description_uz" label="Matn (UZ)" :value="$ad->description_uz"
                        :rows="8" :height="416" />
                </div>

                <div class="row g-3 ad-lang-panel d-none" data-lang-panel="ru">
                    <div class="col-md-12">
                        <label class="form-label">Sarlavha (RU) *</label>
                        <input type="text" name="title_ru" class="form-control @error('title_ru') is-invalid @enderror"
                            value="{{ old('title_ru', $ad->title_ru) }}">
                        @error('title_ru') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <x-admin.summernote-field name="description_ru" label="Matn (RU)" :value="$ad->description_ru"
                        :rows="8" :height="416" />
                </div>

                <div class="row g-3 ad-lang-panel d-none" data-lang-panel="en">
                    <div class="col-md-12">
                        <label class="form-label">Sarlavha (EN) *</label>
                        <input type="text" name="title_en" class="form-control @error('title_en') is-invalid @enderror"
                            value="{{ old('title_en', $ad->title_en) }}">
                        @error('title_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <x-admin.summernote-field name="description_en" label="Matn (EN)" :value="$ad->description_en"
                        :rows="8" :height="416" />
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <label class="form-label">Tartib *</label>
                        <input type="number" min="0" name="order" value="{{ old('order', $ad->order) }}"
                            class="form-control @error('order') is-invalid @enderror">
                        @error('order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Holati *</label>
                        <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">
                            <option value="1" {{ old('is_active', $ad->is_active) == 1 ? 'selected' : '' }}>Aktiv</option>
                            <option value="0" {{ old('is_active', $ad->is_active) == 0 ? 'selected' : '' }}>Nofaol</option>
                        </select>
                        @error('is_active') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Fayllar</label>
                        @if ($ad->files->isNotEmpty())
                            <div class="d-flex flex-column gap-2 mb-2">
                                @foreach ($ad->files as $file)
                                    <div class="d-flex align-items-center justify-content-between gap-2 p-2 rounded border bg-body-secondary">
                                        <a href="{{ asset('storage/' . $file->file) }}" target="_blank" rel="noopener noreferrer"
                                            class="small text-truncate">
                                            {{ $file->displayName() }}
                                        </a>
                                        <button type="submit" form="ad-file-destroy-{{ $file->id }}"
                                            class="btn btn-sm btn-outline-danger p-1"
                                            onclick="return confirm('Fayl o\'chirilsinmi?')"
                                            title="Faylni o'chirish" style="line-height: 1;">
                                            <i data-feather="x" class="w-3 h-3"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <input type="file" name="files[]" multiple accept=".pdf,.doc,.docx"
                            class="form-control @error('files') is-invalid @enderror @error('files.*') is-invalid @enderror">
                        @error('files') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        @error('files.*') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2 justify-content-end">
                    <button type="submit" class="btn btn-primary">Yangilash</button>
                    <a href="{{ route('admin.ads.show', $ad) }}" class="btn btn-outline-info">Ko'rish</a>
                    <a href="{{ route('admin.ads.index') }}" class="btn btn-outline-secondary">Bekor qilish</a>
                </div>
            </form>

            @foreach ($ad->files as $file)
                <form id="ad-file-destroy-{{ $file->id }}"
                    action="{{ route('admin.ads.files.destroy', [$ad, $file]) }}" method="POST"
                    class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach
        </div>
    </div>

    <x-admin.summernote-lang-tabs-script tabs-selector="#ad-lang-tabs-edit [data-lang]"
        panels-selector=".ad-lang-panel" />
@endsection
