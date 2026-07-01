@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0 fw-semibold">Tadbir — tafsilot</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-warning">Tahrirlash</a>
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Orqaga</a>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-12">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-2">Rasm</div>
                        <div class="rounded overflow-hidden border bg-white d-flex justify-content-center align-items-center"
                            style="min-height: 240px;">
                            <img src="{{ asset('storage/' . $event->image) }}" alt="Event image"
                                class="img-fluid w-100" style="max-height: 460px; object-fit: contain;">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-1">Sarlavha (UZ)</div>
                        <div class="fw-semibold">{{ $event->title_uz }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-1">Sarlavha (RU)</div>
                        <div class="fw-semibold">{{ $event->title_ru }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-1">Sarlavha (EN)</div>
                        <div class="fw-semibold">{{ $event->title_en }}</div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Vazifalar (UZ)</div>
                        <div>{!! $event->duties_uz !!}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Vazifalar (RU)</div>
                        <div>{!! $event->duties_ru !!}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Vazifalar (EN)</div>
                        <div>{!! $event->duties_en !!}</div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Holati</div>
                        <button type="button"
                            class="btn btn-sm rounded-pill {{ $event->is_active ? 'btn-success' : 'btn-secondary' }}" disabled>
                            {{ $event->is_active ? 'Aktiv' : 'Nofaol' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
