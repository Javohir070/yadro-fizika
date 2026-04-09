@extends('layouts.admin')

@section('content')
    @include('admin.components.navbar_top', ['maniUrl' => 'Video galereya'])

    <div class="mb-9">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <h2 class="mb-0 fw-semibold">Video galereya</h2>
            <a href="{{ route('admin.video-gallers.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2">
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
                            <th>Sarlavha (UZ)</th>
                            <th>Video havola</th>
                            <th>Tartib</th>
                            <th>Holati</th>
                            <th class="text-end pe-8">Amallar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($videoGallers as $videoGaller)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($videoGaller->title_uz, 50) }}</td>
                                <td>
                                    <a href="{{ $videoGaller->url }}" target="_blank" rel="noopener noreferrer">
                                        {{ \Illuminate\Support\Str::limit($videoGaller->url, 60) }}
                                    </a>
                                </td>
                                <td><span class="badge bg-secondary">{{ $videoGaller->order }}</span></td>
                                <td>
                                    <button type="button"
                                        class="btn btn-sm rounded-pill {{ $videoGaller->is_active ? 'btn-success' : 'btn-secondary' }}"
                                        disabled>
                                        {{ $videoGaller->is_active ? 'Aktiv' : 'Nofaol' }}
                                    </button>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex align-items-center gap-2">
                                        <a href="{{ route('admin.video-gallers.show', $videoGaller) }}" class="btn btn-outline-success"
                                            style="display:inline-block;padding:8px;">
                                            <i data-feather="eye" class="w-4 h-4"></i>
                                        </a>
                                        <a href="{{ route('admin.video-gallers.edit', $videoGaller) }}" class="btn btn-outline-primary"
                                            style="display:inline-block;padding:8px;">
                                            <i data-feather="edit" class="w-4 h-4"></i>
                                        </a>
                                        <form action="{{ route('admin.video-gallers.destroy', $videoGaller) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-outline-danger d-inline-flex align-items-center justify-content-center"
                                                style="width: 36px; height: 36px;"
                                                onclick="return confirm('Video o\'chirilsinmi?')">
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
                                    <a href="{{ route('admin.video-gallers.create') }}" class="btn btn-primary btn-sm">Birinchi videoni
                                        qo'shish</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-transparent border-0 pt-3 pb-3 d-flex justify-content-center">
            {{ $videoGallers->links() }}
        </div>
    </div>
@endsection
