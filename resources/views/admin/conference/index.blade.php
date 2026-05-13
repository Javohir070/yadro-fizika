@extends('layouts.admin')
@section('content')
    @include('admin.components.navbar_top', ['maniUrl' => 'Konferensiyalar'])

    <div class="mb-9">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h2 class="mb-0 fw-semibold">Konferensiyalar</h2>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.conferences.create') }}"
                    class="btn btn-primary d-inline-flex align-items-center gap-2 px-3">
                    <i data-feather="plus" class="w-4 h-4"></i>
                    <span>Qo'shish</span>
                </a>
            </div>
        </div>

        <div id="products">
            @include('admin.components.session')

            <div
                class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1 pt-4 pb-4">
                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                    <table class="table table-report mt-2">
                        <thead>
                            <tr>
                                <th style="width: 40px;">#</th>
                                <th>Sarlavha (UZ)</th>
                                <th>Boshlanish</th>
                                <th>Tartib</th>
                                <th>Holati</th>
                                <th class="text-end pe-8">Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($conferences as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->title_uz }}</td>
                                    <td>{{ $item->start_date?->format('d.m.Y') ?? '—' }}</td>
                                    <td>{{ $item->order }}</td>
                                    <td>
                                        <button type="button"
                                            class="btn btn-sm rounded-pill {{ $item->is_active ? 'btn-success' : 'btn-secondary' }}"
                                            disabled>
                                            {{ $item->is_active ? 'Aktiv' : 'Nofaol' }}
                                        </button>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="d-inline-flex align-items-center gap-2">
                                            <a href="{{ route('admin.conferences.show', $item) }}"
                                                class="btn btn-outline-success" style="display: inline-block;padding:8px;">
                                                <span class="w-5 h-5 flex items-center justify-center">
                                                    <i data-feather="eye" class="w-4 h-4"></i>
                                                </span>
                                            </a>
                                            <a href="{{ route('admin.conferences.edit', $item) }}"
                                                class="btn btn-outline-primary" style="display: inline-block;padding:8px;">
                                                <span class="w-5 h-5 flex items-center justify-center">
                                                    <i data-feather="edit" class="w-4 h-4"></i>
                                                </span>
                                            </a>
                                            <form action="{{ route('admin.conferences.destroy', $item) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-danger d-inline-flex align-items-center justify-content-center"
                                                    style="width: 36px; height: 36px;"
                                                    onclick="return confirm('O\'chirilsinmi?')" title="O'chirish">
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
                                    <td colspan="6" class="text-center py-5">
                                        <a href="{{ route('admin.conferences.create') }}" class="btn btn-primary btn-sm">Birinchi
                                            yozuvni qo'shish</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer bg-transparent border-0 pt-3 pb-3 d-flex justify-content-center">
                {{ $conferences->links() }}
            </div>
        </div>
    </div>
@endsection
