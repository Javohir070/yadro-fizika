@extends('layouts.admin')

@section('content')
    @include('admin.components.navbar_top', ['maniUrl' => 'Video ma\'lumotlari'])

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0 fw-semibold">Video ma'lumotlari</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.video-gallers.edit', $videoGaller) }}" class="btn btn-warning">Tahrirlash</a>
            <a href="{{ route('admin.video-gallers.index') }}" class="btn btn-secondary">Orqaga</a>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-2">Sarlavha</div>
                        <div class="fw-semibold">{{ $videoGaller->title_uz }}</div>
                        <div class="small text-body-tertiary mt-1">{{ $videoGaller->title_ru }}</div>
                        <div class="small text-body-tertiary">{{ $videoGaller->title_en }}</div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-2">Video URL</div>
                        <a href="{{ $videoGaller->url }}" target="_blank" rel="noopener noreferrer">
                            {{ $videoGaller->url }}
                        </a>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="ratio ratio-16x9 rounded overflow-hidden border">
                        <iframe src="{{ $videoGaller->url }}" title="Video preview" allowfullscreen></iframe>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Tavsif (UZ)</div>
                        <div>{{ $videoGaller->description_uz ?: '-' }}</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Tavsif (RU)</div>
                        <div>{{ $videoGaller->description_ru ?: '-' }}</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Tavsif (EN)</div>
                        <div>{{ $videoGaller->description_en ?: '-' }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Tartib</div>
                        <span class="badge bg-secondary">{{ $videoGaller->order }}</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Holati</div>
                        <button type="button"
                            class="btn btn-sm rounded-pill {{ $videoGaller->is_active ? 'btn-success' : 'btn-secondary' }}"
                            disabled>
                            {{ $videoGaller->is_active ? 'Aktiv' : 'Nofaol' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
