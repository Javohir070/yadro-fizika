@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0 fw-semibold">Rasm tafsiloti</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.images.edit', $image) }}" class="btn btn-warning">Tahrirlash</a>
            <a href="{{ route('admin.images.index') }}" class="btn btn-secondary">Orqaga</a>
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
                            <img src="{{ asset('storage/' . $image->image) }}" alt="Image"
                                class="img-fluid w-100" style="max-height: 460px; object-fit: contain;">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Yangilik</div>
                        <div class="fw-semibold">{{ $image->news?->title_uz }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Holati</div>
                        <button type="button"
                            class="btn btn-sm rounded-pill {{ $image->is_active ? 'btn-success' : 'btn-secondary' }}" disabled>
                            {{ $image->is_active ? 'Aktiv' : 'Nofaol' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
