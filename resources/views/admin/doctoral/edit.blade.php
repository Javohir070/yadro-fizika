@extends('layouts.admin')

@section('content')
    <style>
        #doctoral-lang-tabs-edit .doctoral-lang-tab-btn {
            border-bottom: 2px solid transparent !important;
            border-radius: 0;
        }

        #doctoral-lang-tabs-edit .doctoral-lang-tab-btn.active {
            border-bottom-color: #f4a259 !important;
        }
    </style>

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0">Doktorantura — tahrirlash</h3>
        <a href="{{ route('admin.doctorals.index') }}" class="btn btn-secondary">Orqaga</a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('admin.doctorals.update', $doctoral) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <ul class="nav nav-underline mb-3" id="doctoral-lang-tabs-edit">
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link doctoral-lang-tab-btn active fw-semibold w-100 border-0 bg-transparent"
                            data-lang="uz">O'zbekcha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link doctoral-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="ru">Ruscha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link doctoral-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="en">English</button>
                    </li>
                </ul>

                <div class="row g-3 doctoral-lang-panel-edit" data-lang-panel="uz">
                    <div class="col-md-12">
                        <label class="form-label">Nomi (UZ) *</label>
                        <input type="text" name="name_uz" value="{{ old('name_uz', $doctoral->name_uz) }}"
                            class="form-control @error('name_uz') is-invalid @enderror">
                        @error('name_uz') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 doctoral-lang-panel-edit d-none" data-lang-panel="ru">
                    <div class="col-md-12">
                        <label class="form-label">Nomi (RU) *</label>
                        <input type="text" name="name_ru" value="{{ old('name_ru', $doctoral->name_ru) }}"
                            class="form-control @error('name_ru') is-invalid @enderror">
                        @error('name_ru') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 doctoral-lang-panel-edit d-none" data-lang-panel="en">
                    <div class="col-md-12">
                        <label class="form-label">Nomi (EN) *</label>
                        <input type="text" name="name_en" value="{{ old('name_en', $doctoral->name_en) }}"
                            class="form-control @error('name_en') is-invalid @enderror">
                        @error('name_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <label class="form-label">Kod *</label>
                        <input type="text" name="code" value="{{ old('code', $doctoral->code) }}"
                            class="form-control @error('code') is-invalid @enderror">
                        @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Fayl (PDF, DOC)</label>
                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror"
                            accept=".pdf,.doc,.docx">
                        @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Holati *</label>
                        <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">
                            <option value="1" {{ old('is_active', $doctoral->is_active) == 1 ? 'selected' : '' }}>Aktiv</option>
                            <option value="0" {{ old('is_active', $doctoral->is_active) == 0 ? 'selected' : '' }}>Nofaol</option>
                        </select>
                        @error('is_active') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    @if ($doctoral->file)
                        <div class="col-md-12">
                            <a href="{{ asset('storage/' . $doctoral->file) }}" target="_blank" rel="noopener noreferrer"
                                class="btn btn-sm btn-outline-primary">Joriy faylni ochish</a>
                        </div>
                    @endif
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Yangilash</button>
                    <a href="{{ route('admin.doctorals.show', $doctoral) }}" class="btn btn-outline-info">Ko'rish</a>
                    <a href="{{ route('admin.doctorals.index') }}" class="btn btn-outline-secondary">Bekor qilish</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function() {
            const tabs = document.querySelectorAll('#doctoral-lang-tabs-edit [data-lang]');
            const panels = document.querySelectorAll('.doctoral-lang-panel-edit');

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
