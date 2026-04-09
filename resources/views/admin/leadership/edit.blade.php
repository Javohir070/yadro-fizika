@extends('layouts.admin')

@section('content')
    <style>
        #leadership-lang-tabs-edit .leadership-lang-tab-btn {
            border-bottom: 2px solid transparent !important;
            border-radius: 0;
        }

        #leadership-lang-tabs-edit .leadership-lang-tab-btn.active {
            border-bottom-color: #f4a259 !important;
        }
    </style>

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0">Rahbariyat tahrirlash</h3>
        <a href="{{ route('admin.leaderships.index') }}" class="btn btn-secondary">Orqaga</a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('admin.leaderships.update', $leadership) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <ul class="nav nav-underline mb-3" id="leadership-lang-tabs-edit">
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link leadership-lang-tab-btn active fw-semibold w-100 border-0 bg-transparent"
                            data-lang="uz">O'zbekcha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link leadership-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="ru">Ruscha</button>
                    </li>
                    <li class="nav-item col text-center">
                        <button type="button"
                            class="nav-link leadership-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                            data-lang="en">English</button>
                    </li>
                </ul>

                <div class="row g-3 leadership-lang-panel-edit" data-lang-panel="uz">
                    <div class="col-md-6">
                        <label class="form-label">F.I.SH (UZ) *</label>
                        <input type="text" name="full_name_uz" value="{{ old('full_name_uz', $leadership->full_name_uz) }}"
                            class="form-control @error('full_name_uz') is-invalid @enderror">
                        @error('full_name_uz') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Lavozimi (UZ) *</label>
                        <input type="text" name="position_uz" value="{{ old('position_uz', $leadership->position_uz) }}"
                            class="form-control @error('position_uz') is-invalid @enderror">
                        @error('position_uz') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 leadership-lang-panel-edit d-none" data-lang-panel="ru">
                    <div class="col-md-6">
                        <label class="form-label">F.I.SH (RU) *</label>
                        <input type="text" name="full_name_ru" value="{{ old('full_name_ru', $leadership->full_name_ru) }}"
                            class="form-control @error('full_name_ru') is-invalid @enderror">
                        @error('full_name_ru') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Lavozimi (RU) *</label>
                        <input type="text" name="position_ru" value="{{ old('position_ru', $leadership->position_ru) }}"
                            class="form-control @error('position_ru') is-invalid @enderror">
                        @error('position_ru') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 leadership-lang-panel-edit d-none" data-lang-panel="en">
                    <div class="col-md-6">
                        <label class="form-label">F.I.SH (EN) *</label>
                        <input type="text" name="full_name_en" value="{{ old('full_name_en', $leadership->full_name_en) }}"
                            class="form-control @error('full_name_en') is-invalid @enderror">
                        @error('full_name_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Lavozimi (EN) *</label>
                        <input type="text" name="position_en" value="{{ old('position_en', $leadership->position_en) }}"
                            class="form-control @error('position_en') is-invalid @enderror">
                        @error('position_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <label class="form-label">Bo'lim *</label>
                        <select name="department_id" class="form-select @error('department_id') is-invalid @enderror">
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ old('department_id', $leadership->department_id) == $department->id ? 'selected' : '' }}>
                                    {{ $department->name_uz }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Telefon</label>
                        <input type="text" name="phone" value="{{ old('phone', $leadership->phone) }}"
                            class="form-control @error('phone') is-invalid @enderror">
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $leadership->email) }}"
                            class="form-control @error('email') is-invalid @enderror">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Rasm</label>
                        <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
                        @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Holati *</label>
                        <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">
                            <option value="1" {{ old('is_active', $leadership->is_active) == 1 ? 'selected' : '' }}>Aktiv</option>
                            <option value="0" {{ old('is_active', $leadership->is_active) == 0 ? 'selected' : '' }}>Nofaol</option>
                        </select>
                        @error('is_active') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-12">
                        <img src="{{ asset('storage/' . $leadership->photo) }}" alt="{{ $leadership->full_name_uz }}"
                            style="width: 220px; height: 130px; object-fit: cover;" class="rounded border">
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2 justify-content-end">
                    <button type="submit" class="btn btn-primary">Yangilash</button>
                    <a href="{{ route('admin.leaderships.show', $leadership) }}" class="btn btn-outline-info">Ko'rish</a>
                    <a href="{{ route('admin.leaderships.index') }}" class="btn btn-outline-secondary">Bekor qilish</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function() {
            const tabs = document.querySelectorAll('#leadership-lang-tabs-edit [data-lang]');
            const panels = document.querySelectorAll('.leadership-lang-panel-edit');

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
