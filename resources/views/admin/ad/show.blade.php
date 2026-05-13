@extends('layouts.admin')

@section('content')
    @include('admin.components.navbar_top', ['maniUrl' => 'Elon tafsiloti'])

    <style>
        .show-rich-text {
            font-size: 0.95rem;
            line-height: 1.55;
            word-break: break-word;
        }

        .show-rich-text img,
        .show-rich-text video,
        .show-rich-text iframe {
            max-width: 100%;
            height: auto;
        }

        .show-rich-text table {
            max-width: 100%;
        }

        .show-rich-text-scroll {
            max-height: min(70vh, 520px);
            overflow: auto;
        }
    </style>

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <div>
            <h3 class="mb-0 fw-semibold">Elon bloki</h3>
            <div class="text-body-tertiary fs-9 mt-1">ID: {{ $ad->id }}</div>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('admin.ads.edit', $ad) }}" class="btn btn-warning">Tahrirlash</a>
            <a href="{{ route('admin.ads.index') }}" class="btn btn-secondary">Orqaga</a>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary h-100">
                        <div class="text-body-tertiary fs-9 mb-1">Sarlavha (UZ)</div>
                        <div class="fw-semibold">{{ $ad->title_uz }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary h-100">
                        <div class="text-body-tertiary fs-9 mb-1">Sarlavha (RU)</div>
                        <div class="fw-semibold">{{ $ad->title_ru }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary h-100">
                        <div class="text-body-tertiary fs-9 mb-1">Sarlavha (EN)</div>
                        <div class="fw-semibold">{{ $ad->title_en }}</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 rounded border h-100">
                        <div class="text-body-tertiary fs-9 mb-2">Tartib</div>
                        <span class="badge bg-secondary fs-8">{{ $ad->order }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border h-100">
                        <div class="text-body-tertiary fs-9 mb-2">Holati</div>
                        <button type="button"
                            class="btn btn-sm rounded-pill {{ $ad->is_active ? 'btn-success' : 'btn-secondary' }}"
                            disabled>
                            {{ $ad->is_active ? 'Aktiv' : 'Nofaol' }}
                        </button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border h-100">
                        <div class="text-body-tertiary fs-9 mb-1">Yaratilgan</div>
                        <div class="small">{{ $ad->created_at?->format('d.m.Y H:i') ?? '—' }}</div>
                        <div class="text-body-tertiary fs-9 mt-2 mb-1">Yangilangan</div>
                        <div class="small">{{ $ad->updated_at?->format('d.m.Y H:i') ?? '—' }}</div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Matn (UZ)</div>
                        @if (filled(strip_tags($ad->description_uz ?? '')))
                            <div class="show-rich-text show-rich-text-scroll border rounded p-3 bg-body-secondary bg-opacity-25">
                                {!! $ad->description_uz !!}
                            </div>
                        @else
                            <span class="text-body-tertiary">—</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="p-3 rounded border h-100">
                        <div class="text-body-tertiary fs-9 mb-2">Matn (RU)</div>
                        @if (filled(strip_tags($ad->description_ru ?? '')))
                            <div class="show-rich-text show-rich-text-scroll border rounded p-3 bg-body-secondary bg-opacity-25">
                                {!! $ad->description_ru !!}
                            </div>
                        @else
                            <span class="text-body-tertiary">—</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="p-3 rounded border h-100">
                        <div class="text-body-tertiary fs-9 mb-2">Matn (EN)</div>
                        @if (filled(strip_tags($ad->description_en ?? '')))
                            <div class="show-rich-text show-rich-text-scroll border rounded p-3 bg-body-secondary bg-opacity-25">
                                {!! $ad->description_en !!}
                            </div>
                        @else
                            <span class="text-body-tertiary">—</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
