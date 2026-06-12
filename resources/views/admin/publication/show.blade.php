@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0 fw-semibold">Nashr — tafsilot</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.publications.edit', $publication) }}" class="btn btn-warning">Tahrirlash</a>
            <a href="{{ route('admin.publications.index') }}" class="btn btn-secondary">Orqaga</a>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-1">Sarlavha (UZ)</div>
                        <div class="fw-semibold">{{ $publication->title_uz }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-1">Sarlavha (RU)</div>
                        <div class="fw-semibold">{{ $publication->title_ru }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-1">Sarlavha (EN)</div>
                        <div class="fw-semibold">{{ $publication->title_en }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Turi</div>
                        <span class="badge rounded-pill bg-primary-subtle text-primary fs-9">
                            {{ $publication->type->label() }}
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Tartib</div>
                        <span class="badge bg-secondary fs-6">{{ $publication->order }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Holati</div>
                        <button type="button"
                            class="btn btn-sm rounded-pill {{ $publication->is_active ? 'btn-success' : 'btn-secondary' }}" disabled>
                            {{ $publication->is_active ? 'Aktiv' : 'Nofaol' }}
                        </button>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Fayl</div>
                        <a href="{{ asset('storage/'.$publication->file) }}" target="_blank" rel="noopener noreferrer"
                            class="btn btn-primary">Yuklab olish / ochish</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
