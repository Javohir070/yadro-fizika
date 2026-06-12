@extends('layouts.admin')

@section('content')
    @include('admin.components.navbar_top', ['maniUrl' => 'Nashrlar'])

    <div class="mb-9">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <h2 class="mb-0 fw-semibold">Nashrlar</h2>
            <a href="{{ route('admin.publications.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2">
                <i data-feather="plus" class="w-4 h-4"></i>
                <span>Qo'shish</span>
            </a>
        </div>

        @include('admin.components.session')

        <div
            class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1 pt-4 pb-4">
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report mt-2">
                    <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>Tartib</th>
                            <th>Sarlavha (UZ)</th>
                            <th>Turi</th>
                            <th>Fayl</th>
                            <th>Holati</th>
                            <th class="text-end pe-8">Amallar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($publications as $publication)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td><span class="badge bg-secondary">{{ $publication->order }}</span></td>
                                <td>{{ $publication->title_uz }}</td>
                                <td>
                                    <span class="badge rounded-pill bg-primary-subtle text-primary">
                                        {{ $publication->type->label() }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ asset('storage/'.$publication->file) }}" target="_blank" rel="noopener noreferrer"
                                        class="btn btn-sm btn-outline-primary">Yuklab olish</a>
                                </td>
                                <td>
                                    <button type="button"
                                        class="btn btn-sm rounded-pill {{ $publication->is_active ? 'btn-success' : 'btn-secondary' }}"
                                        disabled>
                                        {{ $publication->is_active ? 'Aktiv' : 'Nofaol' }}
                                    </button>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex align-items-center gap-2">
                                        <a href="{{ route('admin.publications.show', $publication) }}" class="btn btn-outline-success"
                                            style="display:inline-block;padding:8px;">
                                            <i data-feather="eye" class="w-4 h-4"></i>
                                        </a>
                                        <a href="{{ route('admin.publications.edit', $publication) }}" class="btn btn-outline-primary"
                                            style="display:inline-block;padding:8px;">
                                            <i data-feather="edit" class="w-4 h-4"></i>
                                        </a>
                                        <form action="{{ route('admin.publications.destroy', $publication) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-outline-danger d-inline-flex align-items-center justify-content-center"
                                                style="width: 36px; height: 36px;"
                                                onclick="return confirm('Nashr o\'chirilsinmi?')">
                                                <span class="w-5 h-5 flex items-center justify-center">
                                                    <i data-feather="trash" class="w-4 h-4"></i>
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <a href="{{ route('admin.publications.create') }}" class="btn btn-primary btn-sm">Birinchi nashrni qo'shish</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-transparent border-0 pt-3 pb-3 d-flex justify-content-center">
            {{ $publications->links() }}
        </div>
    </div>
@endsection
