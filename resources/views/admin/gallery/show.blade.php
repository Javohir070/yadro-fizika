@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0 fw-semibold">Galereya</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-warning">Tahrirlash</a>
            <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Orqaga</a>
        </div>
    </div>

    @include('admin.components.session')

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Sarlavha (UZ)</div>
                        <div class="fw-semibold">{{ $gallery->title_uz }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Sarlavha (RU)</div>
                        <div class="fw-semibold">{{ $gallery->title_ru }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Sarlavha (EN)</div>
                        <div class="fw-semibold">{{ $gallery->title_en }}</div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-2">Asosiy rasm</div>
                        <div class="rounded overflow-hidden border bg-white d-flex justify-content-center align-items-center"
                            style="min-height: 240px;">
                            <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title_uz }}"
                                class="img-fluid w-100" style="max-height: 460px; object-fit: contain;">
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Qo'shimcha rasmlar ({{ $gallery->images->count() }})</div>
                        @if ($gallery->images->isNotEmpty())
                            <div class="d-flex flex-wrap gap-3">
                                @foreach ($gallery->images as $image)
                                    <div class="position-relative">
                                        <a href="{{ asset('storage/' . $image->image) }}" target="_blank" rel="noopener noreferrer">
                                            <img src="{{ asset('storage/' . $image->image) }}" alt="Gallery image"
                                                style="width: 120px; height: 80px; object-fit: cover;" class="rounded border">
                                        </a>
                                        <form action="{{ route('admin.images.destroy', $image) }}" method="POST"
                                            class="position-absolute top-0 end-0 m-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger p-1"
                                                onclick="return confirm('Rasm o\'chirilsinmi?')"
                                                style="line-height: 1;">
                                                <i data-feather="x" class="w-3 h-3"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <span class="text-body-tertiary">Qo'shimcha rasm biriktirilmagan</span>
                        @endif
                    </div>
                </div>

                <div class="col-12">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-2">Qo'shimcha rasm biriktirish</div>
                        <form action="{{ route('admin.galleries.images.store', $gallery) }}" method="POST"
                            enctype="multipart/form-data" class="row g-3">
                            @csrf
                            <div class="col-md-10">
                                <input type="file" name="images[]" multiple
                                    class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
                                    accept=".jpg,.jpeg,.png,.webp" required>
                                @error('images') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                @error('images.*') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">Biriktirish</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Holati</div>
                        <button type="button"
                            class="btn btn-sm rounded-pill {{ $gallery->is_active ? 'btn-success' : 'btn-secondary' }}" disabled>
                            {{ $gallery->is_active ? 'Aktiv' : 'Nofaol' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
