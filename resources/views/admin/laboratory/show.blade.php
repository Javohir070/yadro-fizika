@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0 fw-semibold">Laboratoriya — tafsilot</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.laboratories.edit', $laboratory) }}" class="btn btn-warning">Tahrirlash</a>
            <a href="{{ route('admin.laboratories.index') }}" class="btn btn-secondary">Orqaga</a>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Tartib</div>
                        <span class="badge bg-secondary fs-8">{{ $laboratory->order }}</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Holati</div>
                        <button type="button"
                            class="btn btn-sm rounded-pill {{ $laboratory->is_active ? 'btn-success' : 'btn-secondary' }}"
                            disabled>
                            {{ $laboratory->is_active ? 'Aktiv' : 'Nofaol' }}
                        </button>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Nomi (UZ)</div>
                        <div>{{ $laboratory->name_uz }}</div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Tafsilot (UZ)</div>
                        <div>{!! $laboratory->details_uz !!}</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Nomi (RU)</div>
                        <div>{{ $laboratory->name_ru }}</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Nomi (EN)</div>
                        <div>{{ $laboratory->name_en }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Tafsilot (RU)</div>
                        <div>{!! $laboratory->details_ru !!}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Tafsilot (EN)</div>
                        <div>{!! $laboratory->details_en !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
