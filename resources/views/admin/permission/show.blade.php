@extends('layouts.admin')

@section('content')
    @include('admin.components.navbar_top', ['maniUrl' => 'Ruxsat'])

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0">{{ $permission->name }}</h3>
        <div class="d-flex gap-2">
            @can('Ruxsatlar')
                <a href="{{ route('admin.permissions.edit', $permission) }}" class="btn btn-primary">Tahrirlash</a>
            @endcan
            <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Orqaga</a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">Nomi</dt>
                <dd class="col-sm-9">{{ $permission->name }}</dd>

                <dt class="col-sm-3">Guard</dt>
                <dd class="col-sm-9">{{ $permission->guard_name }}</dd>

                <dt class="col-sm-3">Yaratilgan</dt>
                <dd class="col-sm-9">{{ $permission->created_at?->format('d.m.Y H:i') }}</dd>
            </dl>
        </div>
    </div>
@endsection
