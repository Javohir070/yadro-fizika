@extends('layouts.admin')

@section('content')
    @include('admin.components.navbar_top', ['maniUrl' => 'Stat tahrirlash'])

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0">Stat tahrirlash</h3>
        <a href="{{ route('admin.stats.index') }}" class="btn btn-secondary">Orqaga</a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('admin.stats.update', $stat) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Nomi (UZ) *</label>
                        <input type="text" name="title_uz" value="{{ old('title_uz', $stat->title_uz) }}"
                            class="form-control @error('title_uz') is-invalid @enderror" required>
                        @error('title_uz') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Nomi (RU) *</label>
                        <input type="text" name="title_ru" value="{{ old('title_ru', $stat->title_ru) }}"
                            class="form-control @error('title_ru') is-invalid @enderror" required>
                        @error('title_ru') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Nomi (EN) *</label>
                        <input type="text" name="title_en" value="{{ old('title_en', $stat->title_en) }}"
                            class="form-control @error('title_en') is-invalid @enderror" required>
                        @error('title_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Qiymat *</label>
                        <input type="number" min="0" name="value" value="{{ old('value', $stat->value) }}"
                            class="form-control @error('value') is-invalid @enderror" required>
                        @error('value') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Suffix</label>
                        <input type="text" name="suffix" value="{{ old('suffix', $stat->suffix) }}"
                            class="form-control @error('suffix') is-invalid @enderror" placeholder="+">
                        @error('suffix') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tartib *</label>
                        <input type="number" min="0" name="order" value="{{ old('order', $stat->order) }}"
                            class="form-control @error('order') is-invalid @enderror" required>
                        @error('order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Holati *</label>
                        <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">
                            <option value="1" @selected(old('is_active', $stat->is_active ? '1' : '0') == '1')>Aktiv</option>
                            <option value="0" @selected(old('is_active', $stat->is_active ? '1' : '0') == '0')>Nofaol</option>
                        </select>
                        @error('is_active') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2 justify-content-end">
                    <button type="submit" class="btn btn-primary">Yangilash</button>
                    <a href="{{ route('admin.stats.show', $stat) }}" class="btn btn-outline-info">Ko'rish</a>
                    <a href="{{ route('admin.stats.index') }}" class="btn btn-outline-secondary">Bekor qilish</a>
                </div>
            </form>
        </div>
    </div>
@endsection
