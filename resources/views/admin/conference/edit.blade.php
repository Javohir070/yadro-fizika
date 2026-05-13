@extends('layouts.admin')

@section('content')
    @include('admin.components.navbar_top', ['maniUrl' => 'Konferensiya tahrirlash'])

    <style>
        #conference-lang-tabs-edit .conference-lang-tab-btn {
            border-bottom: 2px solid transparent !important;
            border-radius: 0;
        }

        #conference-lang-tabs-edit .conference-lang-tab-btn.active {
            border-bottom-color: #f4a259 !important;
        }
    </style>

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0">Konferensiya tahrirlash</h3>
        <a href="{{ route('admin.conferences.index') }}" class="btn btn-secondary">Orqaga</a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('admin.conferences.update', $conference) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <ul class="nav nav-underline mb-3" id="conference-lang-tabs-edit">
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link conference-lang-tab-btn active fw-semibold w-100 border-0 bg-transparent"
                            data-lang="uz">O'zbekcha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link conference-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="ru">Ruscha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link conference-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="en">English</button>
                    </li>
                </ul>

                <div class="row g-3 conference-lang-panel" data-lang-panel="uz">
                    <div class="col-md-12">
                        <label class="form-label">Sarlavha (UZ) *</label>
                        <input type="text" name="title_uz" class="form-control @error('title_uz') is-invalid @enderror"
                            value="{{ old('title_uz', $conference->title_uz) }}">
                        @error('title_uz') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Joy (UZ) *</label>
                        <input type="text" name="location_uz"
                            class="form-control @error('location_uz') is-invalid @enderror"
                            value="{{ old('location_uz', $conference->location_uz) }}">
                        @error('location_uz') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <x-admin.summernote-field name="description_uz" label="Matn (UZ)" :value="$conference->description_uz"
                        :rows="8" :height="416" />
                </div>

                <div class="row g-3 conference-lang-panel d-none" data-lang-panel="ru">
                    <div class="col-md-12">
                        <label class="form-label">Sarlavha (RU) *</label>
                        <input type="text" name="title_ru" class="form-control @error('title_ru') is-invalid @enderror"
                            value="{{ old('title_ru', $conference->title_ru) }}">
                        @error('title_ru') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Joy (RU) *</label>
                        <input type="text" name="location_ru"
                            class="form-control @error('location_ru') is-invalid @enderror"
                            value="{{ old('location_ru', $conference->location_ru) }}">
                        @error('location_ru') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <x-admin.summernote-field name="description_ru" label="Matn (RU)" :value="$conference->description_ru"
                        :rows="8" :height="416" />
                </div>

                <div class="row g-3 conference-lang-panel d-none" data-lang-panel="en">
                    <div class="col-md-12">
                        <label class="form-label">Sarlavha (EN) *</label>
                        <input type="text" name="title_en" class="form-control @error('title_en') is-invalid @enderror"
                            value="{{ old('title_en', $conference->title_en) }}">
                        @error('title_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Joy (EN) *</label>
                        <input type="text" name="location_en"
                            class="form-control @error('location_en') is-invalid @enderror"
                            value="{{ old('location_en', $conference->location_en) }}">
                        @error('location_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <x-admin.summernote-field name="description_en" label="Matn (EN)" :value="$conference->description_en"
                        :rows="8" :height="416" />
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-4">
                        <label class="form-label">Boshlanish sanasi *</label>
                        <input type="date" name="start_date"
                            value="{{ old('start_date', $conference->start_date?->format('Y-m-d')) }}"
                            class="form-control @error('start_date') is-invalid @enderror">
                        @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tugash sanasi</label>
                        <input type="date" name="end_date"
                            value="{{ old('end_date', $conference->end_date?->format('Y-m-d')) }}"
                            class="form-control @error('end_date') is-invalid @enderror">
                        @error('end_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tartib *</label>
                        <input type="number" min="0" name="order" value="{{ old('order', $conference->order) }}"
                            class="form-control @error('order') is-invalid @enderror">
                        @error('order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Rasm</label>
                        @if ($conference->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $conference->image) }}" alt=""
                                    class="rounded border" style="max-height: 120px; object-fit: cover;">
                            </div>
                        @endif
                        <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp"
                            class="form-control @error('image') is-invalid @enderror">
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">PDF fayl</label>
                        @if ($conference->file)
                            <div class="mb-2 small">
                                <a href="{{ asset('storage/' . $conference->file) }}" target="_blank" rel="noopener noreferrer">Joriy
                                    fayl</a>
                            </div>
                        @endif
                        <input type="file" name="file" accept=".pdf"
                            class="form-control @error('file') is-invalid @enderror">
                        @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Holati *</label>
                        <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">
                            <option value="1" {{ old('is_active', $conference->is_active) == 1 ? 'selected' : '' }}>Aktiv
                            </option>
                            <option value="0" {{ old('is_active', $conference->is_active) == 0 ? 'selected' : '' }}>Nofaol
                            </option>
                        </select>
                        @error('is_active') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2 justify-content-end">
                    <button type="submit" class="btn btn-primary">Yangilash</button>
                    <a href="{{ route('admin.conferences.show', $conference) }}" class="btn btn-outline-info">Ko'rish</a>
                    <a href="{{ route('admin.conferences.index') }}" class="btn btn-outline-secondary">Bekor qilish</a>
                </div>
            </form>
        </div>
    </div>

    <x-admin.summernote-lang-tabs-script tabs-selector="#conference-lang-tabs-edit [data-lang]"
        panels-selector=".conference-lang-panel" />
@endsection
