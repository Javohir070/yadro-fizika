@extends('layouts.admin')

@section('content')
    @php
        $imagePath = $about->image;
        $imageUrl = $imagePath ? asset('storage/' . ltrim($imagePath, '/')) : null;
    @endphp

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0 fw-semibold">About tafsiloti</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.abouts.edit', $about) }}" class="btn btn-warning">Tahrirlash</a>
            <a href="{{ route('admin.abouts.index') }}" class="btn btn-secondary">Orqaga</a>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3">
                @if ($imageUrl)
                    <div class="col-12">
                        <div class="p-3 rounded border bg-body-secondary">
                            <div class="text-body-tertiary fs-9 mb-2">Rasm</div>
                            <div class="rounded overflow-hidden border bg-white d-flex justify-content-center align-items-center"
                                style="min-height: 240px;">
                                <img src="{{ $imageUrl }}" alt="About image" class="img-fluid w-100"
                                    style="max-height: 420px; object-fit: cover;">
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-md-12">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Content UZ</div>
                        <div>{!! $about->content_uz !!}</div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Holati</div>
                        <button type="button"
                            class="btn btn-sm rounded-pill {{ $about->is_active ? 'btn-success' : 'btn-secondary' }}" disabled>
                            {{ $about->is_active ? 'Aktiv' : 'Nofaol' }}
                        </button>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Content RU</div>
                        <div>{!! $about->content_ru !!}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Content EN</div>
                        <div>{!! $about->content_en !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
