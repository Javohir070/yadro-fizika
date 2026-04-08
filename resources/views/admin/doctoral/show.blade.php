@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0 fw-semibold">Doktorantura — tafsilot</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.doctorals.edit', $doctoral) }}" class="btn btn-warning">Tahrirlash</a>
            <a href="{{ route('admin.doctorals.index') }}" class="btn btn-secondary">Orqaga</a>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-1">Nomi (UZ)</div>
                        <div class="fw-semibold">{{ $doctoral->name_uz }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-1">Nomi (RU)</div>
                        <div class="fw-semibold">{{ $doctoral->name_ru }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-1">Nomi (EN)</div>
                        <div class="fw-semibold">{{ $doctoral->name_en }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Kod</div>
                        <span class="badge bg-secondary fs-6">{{ $doctoral->code }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Holati</div>
                        <button type="button"
                            class="btn btn-sm rounded-pill {{ $doctoral->is_active ? 'btn-success' : 'btn-secondary' }}" disabled>
                            {{ $doctoral->is_active ? 'Aktiv' : 'Nofaol' }}
                        </button>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Fayl</div>
                        @if ($doctoral->file)
                            <a href="{{ asset('storage/' . $doctoral->file) }}" target="_blank" rel="noopener noreferrer"
                                class="btn btn-primary">Yuklab olish / ochish</a>
                        @else
                            <span class="text-body-tertiary">Fayl biriktirilmagan</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
