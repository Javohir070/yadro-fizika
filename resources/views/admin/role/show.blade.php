@extends('layouts.admin')

@section('content')
    @include('admin.components.navbar_top', ['maniUrl' => 'Rol'])

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0">{{ $role->name }}</h3>
        <div class="d-flex gap-2">
            @can('Rollar')
                <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-primary">Tahrirlash</a>
            @endcan
            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Orqaga</a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h6 class="fw-semibold mb-3">Biriktirilgan ruxsatlar</h6>
            @forelse ($role->permissions as $permission)
                <span class="badge bg-primary-subtle text-primary-emphasis me-1 mb-1">{{ $permission->name }}</span>
            @empty
                <p class="text-body-tertiary mb-0">Ruxsat berilmagan</p>
            @endforelse
        </div>
    </div>
@endsection
