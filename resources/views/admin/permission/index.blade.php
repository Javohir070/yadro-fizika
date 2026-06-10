@extends('layouts.admin')

@section('content')
    @include('admin.components.navbar_top', ['maniUrl' => 'Ruxsatlar'])

    <div class="mb-9">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <h2 class="mb-0 fw-semibold">Ruxsatlar</h2>
            @can('Ruxsatlar')
                <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2">
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
                        <th class="text-end pe-8">Amallar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $permission)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $permission->name }}</td>
                            <td class="text-end pe-4">
                                <div class="d-inline-flex align-items-center gap-2">
                                    @can('Ruxsatlar')
                                        <a href="{{ route('admin.permissions.show', $permission) }}" class="btn btn-outline-success" style="display:inline-block;padding:8px;">
                                            <i data-feather="eye" class="w-4 h-4"></i>
                                        </a>
                                    @endcan
                                    @can('Ruxsatlar')
                                        <a href="{{ route('admin.permissions.edit', $permission) }}" class="btn btn-outline-primary" style="display:inline-block;padding:8px;">
                                            <i data-feather="edit" class="w-4 h-4"></i>
                                        </a>
                                    @endcan
                                    @can('Ruxsatlar')
                                        <form action="{{ route('admin.permissions.destroy', $permission) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center justify-content-center"
                                                style="width: 36px; height: 36px;" onclick="return confirm('Ruxsat o\'chirilsinmi?')">
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
                            <td colspan="3" class="text-center py-5">
                                @can('Ruxsatlar')
                                    <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary btn-sm">Birinchi ruxsatni qo'shish</a>
                                @endcan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer bg-transparent border-0 pt-3 pb-3 d-flex justify-content-center">
            {{ $permissions->links() }}
        </div>
    </div>
@endsection
