@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0 fw-semibold">Institut tarixi — tafsilot</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.institute-histories.edit', $instituteHistory) }}" class="btn btn-warning">Tahrirlash</a>
            <a href="{{ route('admin.institute-histories.index') }}" class="btn btn-secondary">Orqaga</a>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Holati</div>
                        <button type="button"
                            class="btn btn-sm rounded-pill {{ $instituteHistory->is_active ? 'btn-success' : 'btn-secondary' }}"
                            disabled>
                            {{ $instituteHistory->is_active ? 'Aktiv' : 'Nofaol' }}
                        </button>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Tafsilot (UZ)</div>
                        <div>{!! $instituteHistory->details_uz !!}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Tafsilot (RU)</div>
                        <div>{!! $instituteHistory->details_ru !!}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Tafsilot (EN)</div>
                        <div>{!! $instituteHistory->details_en !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
