@extends('layouts.admin')

@section('content')
    @include('admin.components.navbar_top', ['maniUrl' => 'Foydalanuvchi'])

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0">{{ $user->name }}</h3>
        <div class="d-flex gap-2">
            @can('Foydalanuvchilar')
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">Tahrirlash</a>
            @endcan
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Orqaga</a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">Ism</dt>
                <dd class="col-sm-9">{{ $user->name }}</dd>

                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">{{ $user->email }}</dd>

                <dt class="col-sm-3">Rollar</dt>
                <dd class="col-sm-9">
                    @forelse ($user->roles as $role)
                        <span class="badge bg-primary-subtle text-primary-emphasis me-1">{{ $role->name }}</span>
                    @empty
                        <span class="text-body-tertiary">Rol berilmagan</span>
                    @endforelse
                </dd>

                <dt class="col-sm-3">To'g'ridan-to'g'ri ruxsatlar</dt>
                <dd class="col-sm-9">
                    @forelse ($user->permissions as $permission)
                        <span class="badge bg-secondary-subtle text-secondary-emphasis me-1">{{ $permission->name }}</span>
                    @empty
                        <span class="text-body-tertiary">Yo'q (faqat rol orqali)</span>
                    @endforelse
                </dd>

                <dt class="col-sm-3">Yaratilgan</dt>
                <dd class="col-sm-9">{{ $user->created_at?->format('d.m.Y H:i') }}</dd>
            </dl>
        </div>
    </div>
@endsection
