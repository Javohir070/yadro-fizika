@extends('layouts.admin')

@section('content')
    @php
        $imageUrl = asset('storage/' . ltrim($partner->image, '/'));
    @endphp

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0 fw-semibold">Hamkor tafsiloti</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.partners.edit', $partner) }}" class="btn btn-warning">Tahrirlash</a>
            <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">Orqaga</a>
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
                            <img src="{{ $imageUrl }}" alt="{{ $partner->name_uz }}" class="img-fluid w-100"
                                style="max-height: 420px; object-fit: cover;">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-1">Nomi (UZ)</div>
                        <div class="fw-semibold">{{ $partner->name_uz }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-1">Nomi (RU)</div>
                        <div class="fw-semibold">{{ $partner->name_ru }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-1">Nomi (EN)</div>
                        <div class="fw-semibold">{{ $partner->name_en }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Tavsif (UZ)</div>
                        <div>{{ $partner->description_uz }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Tavsif (RU)</div>
                        <div>{{ $partner->description_ru }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Tavsif (EN)</div>
                        <div>{{ $partner->description_en }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Havola</div>
                        <a href="{{ $partner->link }}" target="_blank" rel="noopener noreferrer">{{ $partner->link }}</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Holati</div>
                        <button type="button"
                            class="btn btn-sm rounded-pill {{ $partner->is_active ? 'btn-success' : 'btn-secondary' }}" disabled>
                            {{ $partner->is_active ? 'Aktiv' : 'Nofaol' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
