@extends('layouts.admin')

@section('content')
    <style>
        #council-member-lang-tabs-edit .council-member-lang-tab-btn {
            border-bottom: 2px solid transparent !important;
            border-radius: 0;
        }

        #council-member-lang-tabs-edit .council-member-lang-tab-btn.active {
            border-bottom-color: #f4a259 !important;
        }
    </style>

    @include('admin.components.navbar_top', ['maniUrl' => 'Kengash a\'zosini tahrirlash'])

    <div class="mb-9">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <h3 class="mb-0 fw-semibold">Kengash a'zosi — tahrirlash</h3>
            <a href="{{ route('admin.council-members.index') }}" class="btn btn-secondary">Orqaga</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form action="{{ route('admin.council-members.update', $councilMember) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Ilmiy kengash *</label>
                        <select name="scientific_council_id" class="form-select @error('scientific_council_id') is-invalid @enderror">
                            <option value="">Tanlang</option>
                            @foreach ($scientificCouncils as $council)
                                <option value="{{ $council->id }}"
                                    @selected(old('scientific_council_id', $councilMember->scientific_council_id) == $council->id)>
                                    {{ $council->title_uz }}
                                </option>
                            @endforeach
                        </select>
                        @error('scientific_council_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <ul class="nav nav-underline mb-3" id="council-member-lang-tabs-edit">
                        <li class="nav-item col text-center">
                            <button type="button"
                                class="nav-link council-member-lang-tab-btn active fw-semibold w-100 border-0 bg-transparent"
                                data-lang="uz">O'zbekcha</button>
                        </li>
                        <li class="nav-item col text-center">
                            <button type="button"
                                class="nav-link council-member-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                                data-lang="ru">Ruscha</button>
                        </li>
                        <li class="nav-item col text-center">
                            <button type="button"
                                class="nav-link council-member-lang-tab-btn fw-semibold text-body-tertiary w-100 border-0 bg-transparent"
                                data-lang="en">English</button>
                        </li>
                    </ul>

                    <div class="row g-3 council-member-lang-panel" data-lang-panel="uz">
                        <div class="col-md-12">
                            <label class="form-label">F.I.Sh (UZ) *</label>
                            <input type="text" name="full_name_uz"
                                value="{{ old('full_name_uz', $councilMember->full_name_uz) }}"
                                class="form-control @error('full_name_uz') is-invalid @enderror">
                            @error('full_name_uz') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Lavozim (UZ) *</label>
                            <input type="text" name="position_uz"
                                value="{{ old('position_uz', $councilMember->position_uz) }}"
                                class="form-control @error('position_uz') is-invalid @enderror">
                            @error('position_uz') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Ilmiy daraja (UZ) *</label>
                            <input type="text" name="degree_uz"
                                value="{{ old('degree_uz', $councilMember->degree_uz) }}"
                                class="form-control @error('degree_uz') is-invalid @enderror">
                            @error('degree_uz') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row g-3 council-member-lang-panel d-none" data-lang-panel="ru">
                        <div class="col-md-12">
                            <label class="form-label">F.I.Sh (RU) *</label>
                            <input type="text" name="full_name_ru"
                                value="{{ old('full_name_ru', $councilMember->full_name_ru) }}"
                                class="form-control @error('full_name_ru') is-invalid @enderror">
                            @error('full_name_ru') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Lavozim (RU) *</label>
                            <input type="text" name="position_ru"
                                value="{{ old('position_ru', $councilMember->position_ru) }}"
                                class="form-control @error('position_ru') is-invalid @enderror">
                            @error('position_ru') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Ilmiy daraja (RU) *</label>
                            <input type="text" name="degree_ru"
                                value="{{ old('degree_ru', $councilMember->degree_ru) }}"
                                class="form-control @error('degree_ru') is-invalid @enderror">
                            @error('degree_ru') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row g-3 council-member-lang-panel d-none" data-lang-panel="en">
                        <div class="col-md-12">
                            <label class="form-label">F.I.Sh (EN) *</label>
                            <input type="text" name="full_name_en"
                                value="{{ old('full_name_en', $councilMember->full_name_en) }}"
                                class="form-control @error('full_name_en') is-invalid @enderror">
                            @error('full_name_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Lavozim (EN) *</label>
                            <input type="text" name="position_en"
                                value="{{ old('position_en', $councilMember->position_en) }}"
                                class="form-control @error('position_en') is-invalid @enderror">
                            @error('position_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Ilmiy daraja (EN) *</label>
                            <input type="text" name="degree_en"
                                value="{{ old('degree_en', $councilMember->degree_en) }}"
                                class="form-control @error('degree_en') is-invalid @enderror">
                            @error('degree_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <label class="form-label">Rasm</label>
                            <input type="file" name="photo" accept="image/*"
                                class="form-control @error('photo') is-invalid @enderror">
                            @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            @if ($councilMember->photo)
                                <img src="{{ asset('storage/' . $councilMember->photo) }}" alt="{{ $councilMember->full_name_uz }}"
                                    class="img-thumbnail mt-2" style="max-width: 180px;">
                            @endif
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tartib raqami *</label>
                            <input type="number" min="1" name="order"
                                value="{{ old('order', $councilMember->order) }}"
                                class="form-control @error('order') is-invalid @enderror">
                            @error('order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Holati *</label>
                            <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">
                                <option value="1" @selected(old('is_active', $councilMember->is_active ? '1' : '0') == '1')>Aktiv</option>
                                <option value="0" @selected(old('is_active', $councilMember->is_active ? '1' : '0') == '0')>Nofaol</option>
                            </select>
                            @error('is_active') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-2 justify-content-end">
                        <button type="submit" class="btn btn-primary">Yangilash</button>
                        <a href="{{ route('admin.council-members.index') }}" class="btn btn-outline-secondary">Bekor qilish</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        (function() {
            const tabs = document.querySelectorAll('#council-member-lang-tabs-edit [data-lang]');
            const panels = document.querySelectorAll('.council-member-lang-panel');

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
