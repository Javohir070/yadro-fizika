@extends('layouts.admin')

@section('content')
    @php
        $photoUrl = asset('storage/' . ltrim($leadership->photo, '/'));
    @endphp

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0 fw-semibold">Rahbariyat tafsiloti</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.leaderships.edit', $leadership) }}" class="btn btn-warning">Tahrirlash</a>
            <a href="{{ route('admin.leaderships.index') }}" class="btn btn-secondary">Orqaga</a>
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
                            <img src="{{ $photoUrl }}" alt="{{ $leadership->full_name_uz }}" class="img-fluid w-100"
                                style="max-height: 420px; object-fit: cover;">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-1">F.I.SH (UZ)</div>
                        <div class="fw-semibold">{{ $leadership->full_name_uz }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-1">F.I.SH (RU)</div>
                        <div class="fw-semibold">{{ $leadership->full_name_ru }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-1">F.I.SH (EN)</div>
                        <div class="fw-semibold">{{ $leadership->full_name_en }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Lavozimi (UZ)</div>
                        <div>{{ $leadership->position_uz }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Lavozimi (RU)</div>
                        <div>{{ $leadership->position_ru }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Lavozimi (EN)</div>
                        <div>{{ $leadership->position_en }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Bo'lim</div>
                        <div class="fw-semibold">{{ $leadership->department?->name_uz }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Telefon</div>
                        <div>{{ $leadership->phone ?: '-' }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Email</div>
                        <div>{{ $leadership->email ?: '-' }}</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Holati</div>
                        <button type="button"
                            class="btn btn-sm rounded-pill {{ $leadership->is_active ? 'btn-success' : 'btn-secondary' }}" disabled>
                            {{ $leadership->is_active ? 'Aktiv' : 'Nofaol' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
