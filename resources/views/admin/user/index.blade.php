@extends('layouts.admin')

@section('content')
    @include('admin.components.navbar_top', ['maniUrl' => 'Foydalanuvchilar'])

    <div class="mb-9">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <h2 class="mb-0 fw-semibold">Foydalanuvchilar</h2>
            @can('Foydalanuvchilar')
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2">
                    <i data-feather="plus" class="w-4 h-4"></i>
                    <span>Qo'shish</span>
                </a>
            @endcan
        </div>

        @include('admin.components.session')

        <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1 pt-4 pb-4">
            <table class="table table-report mt-2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ism</th>
                        <th>Email</th>
                        <th>Rollar</th>
                        <th class="text-end pe-8">Amallar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @forelse ($user->roles as $role)
                                    <span class="badge bg-primary-subtle text-primary-emphasis me-1">{{ $role->name }}</span>
                                @empty
                                    <span class="text-body-tertiary">Rol yo'q</span>
                                @endforelse
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-inline-flex align-items-center gap-2">
                                    @can('Foydalanuvchilar')
                                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-outline-success" style="display:inline-block;padding:8px;">
                                            <i data-feather="eye" class="w-4 h-4"></i>
                                        </a>
                                    @endcan
                                    @can('Foydalanuvchilar')
                                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-outline-primary" style="display:inline-block;padding:8px;">
                                            <i data-feather="edit" class="w-4 h-4"></i>
                                        </a>
                                    @endcan
                                    @can('Foydalanuvchilar')
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center justify-content-center"
                                                style="width: 36px; height: 36px;" onclick="return confirm('Foydalanuvchi o\'chirilsinmi?')">
                                                <span class="w-5 h-5 flex items-center justify-center">
                                                    <i data-feather="trash" class="w-4 h-4"></i>
                                                </span>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                @can('Foydalanuvchilar')
                                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">Birinchi foydalanuvchini qo'shish</a>
                                @endcan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer bg-transparent border-0 pt-3 pb-3 d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
@endsection
