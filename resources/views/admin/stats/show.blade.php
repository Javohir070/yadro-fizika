@extends('layouts.admin')

@section('content')
    @include('admin.components.navbar_top', ['maniUrl' => 'Stat ma\'lumotlari'])

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0 fw-semibold">Stat ma'lumotlari</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.stats.edit', $stat) }}" class="btn btn-warning">Tahrirlash</a>
            <a href="{{ route('admin.stats.index') }}" class="btn btn-secondary">Orqaga</a>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-1">Nomi (UZ)</div>
                        <div class="fw-semibold">{{ $stat->title_uz }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-1">Nomi (RU)</div>
                        <div class="fw-semibold">{{ $stat->title_ru }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-1">Nomi (EN)</div>
                        <div class="fw-semibold">{{ $stat->title_en }}</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Qiymat</div>
                        <div class="fw-semibold">{{ $stat->value }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Suffix</div>
                        <div class="fw-semibold">{{ $stat->suffix ?: '-' }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Tartib</div>
                        <span class="badge bg-secondary">{{ $stat->order }}</span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Holati</div>
                        <button type="button"
                            class="btn btn-sm rounded-pill {{ $stat->is_active ? 'btn-success' : 'btn-secondary' }}"
                            disabled>
                            {{ $stat->is_active ? 'Aktiv' : 'Nofaol' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
