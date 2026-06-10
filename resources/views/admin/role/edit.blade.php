@extends('layouts.admin')

@section('content')
    @include('admin.components.navbar_top', ['maniUrl' => 'Rolni tahrirlash'])

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0">Rolni tahrirlash: {{ $role->name }}</h3>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Orqaga</a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Rol nomi *</label>
                        <input type="text" name="name" value="{{ old('name', $role->name) }}"
                            class="form-control @error('name') is-invalid @enderror" required
                            @readonly($role->name === 'super-admin')>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Ruxsatlar</label>
                        @include('admin.components.permission-checkboxes', [
                            'permissions' => $permissions,
                            'selected' => $role->permissions->pluck('name')->all(),
                        ])
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2 justify-content-end">
                    <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2">
                        <i data-feather="save" class="w-4 h-4"></i>
                        <span>Saqlash</span>
                    </button>
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">Bekor qilish</a>
                </div>
            </form>
        </div>
    </div>
@endsection
