@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0 fw-semibold">Institut nizomi — tafsilot</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.charters.edit', $charter) }}" class="btn btn-warning">Tahrirlash</a>
            <a href="{{ route('admin.charters.index') }}" class="btn btn-secondary">Orqaga</a>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Holati</div>
                        <button type="button"
                            class="btn btn-sm rounded-pill {{ $charter->is_active ? 'btn-success' : 'btn-secondary' }}"
                            disabled>
                            {{ $charter->is_active ? 'Aktiv' : 'Nofaol' }}
                        </button>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Tafsilot (UZ)</div>
                        <div>{!! $charter->details_uz !!}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Tafsilot (RU)</div>
                        <div>{!! $charter->details_ru !!}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Tafsilot (EN)</div>
                        <div>{!! $charter->details_en !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
