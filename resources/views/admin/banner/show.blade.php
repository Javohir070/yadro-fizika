@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0">Banner tafsiloti</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-warning">Tahrirlash</a>
            <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Orqaga</a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-1">Title UZ</div>
                        <div class="fw-semibold">{{ $banner->title_uz }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-1">Title RU</div>
                        <div class="fw-semibold">{{ $banner->title_ru }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-1">Title EN</div>
                        <div class="fw-semibold">{{ $banner->title_en }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-1">Image path</div>
                        <div class="fw-semibold text-break">{{ $banner->image }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Description UZ</div>
                        <div>{{ $banner->description_uz }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Description RU</div>
                        <div>{{ $banner->description_ru }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Description EN</div>
                        <div>{{ $banner->description_en }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
