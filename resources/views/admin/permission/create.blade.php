@extends('layouts.admin')

@section('content')
    @include('admin.components.navbar_top', ['maniUrl' => 'Ruxsat yaratish'])

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0">Ruxsat yaratish</h3>
        <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Orqaga</a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('admin.permissions.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Ruxsat nomi *</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror" required
                            placeholder="masalan: view banner">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <div class="form-text">Format: action resource (masalan: create user, view role)</div>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2 justify-content-end">
                    <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2">
                        <i data-feather="save" class="w-4 h-4"></i>
                        <span>Saqlash</span>
                    </button>
                    <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-secondary">Bekor qilish</a>
                </div>
            </form>
        </div>
    </div>
@endsection
