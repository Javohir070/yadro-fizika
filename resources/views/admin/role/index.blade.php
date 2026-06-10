@extends('layouts.admin')

@section('content')
    @include('admin.components.navbar_top', ['maniUrl' => 'Rollar'])

    <div class="mb-9">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <h2 class="mb-0 fw-semibold">Rollar</h2>
            @can('Rollar')
                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2">
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
                        <th>Nomi</th>
                        <th>Ruxsatlar soni</th>
                        <th class="text-end pe-8">Amallar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->permissions->count() }}</td>
                            <td class="text-end pe-4">
                                <div class="d-inline-flex align-items-center gap-2">
                                    @can('Rollar')
                                        <a href="{{ route('admin.roles.show', $role) }}" class="btn btn-outline-success" style="display:inline-block;padding:8px;">
                                            <i data-feather="eye" class="w-4 h-4"></i>
                                        </a>
                                    @endcan
                                    @can('Rollar')
                                        <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-outline-primary" style="display:inline-block;padding:8px;">
                                            <i data-feather="edit" class="w-4 h-4"></i>
                                        </a>
                                    @endcan
                                    @can('Rollar')
                                        @if ($role->name !== 'super-admin')
                                            <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center justify-content-center"
                                                    style="width: 36px; height: 36px;" onclick="return confirm('Rol o\'chirilsinmi?')">
                                                    <span class="w-5 h-5 flex items-center justify-center">
                                                        <i data-feather="trash" class="w-4 h-4"></i>
                                                    </span>
                                                </button>
                                            </form>
                                        @endif
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                @can('Rollar')
                                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm">Birinchi rolni qo'shish</a>
                                @endcan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer bg-transparent border-0 pt-3 pb-3 d-flex justify-content-center">
            {{ $roles->links() }}
        </div>
    </div>
@endsection
