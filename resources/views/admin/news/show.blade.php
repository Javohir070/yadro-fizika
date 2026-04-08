@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0 fw-semibold">Yangilik tafsiloti</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.news.edit', $news) }}" class="btn btn-warning">Tahrirlash</a>
            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Orqaga</a>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-1">Sarlavha (UZ)</div>
                        <div class="fw-semibold">{{ $news->title_uz }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-1">Sarlavha (RU)</div>
                        <div class="fw-semibold">{{ $news->title_ru }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-1">Sarlavha (EN)</div>
                        <div class="fw-semibold">{{ $news->title_en }}</div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Tavsif (UZ)</div>
                        <div>{!! $news->description_uz !!}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Tavsif (RU)</div>
                        <div>{!! $news->description_ru !!}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-1">Tavsif (EN)</div>
                        <div>{!! $news->description_en !!}</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Holati</div>
                        <button type="button"
                            class="btn btn-sm rounded-pill {{ $news->is_active ? 'btn-success' : 'btn-secondary' }}" disabled>
                            {{ $news->is_active ? 'Aktiv' : 'Nofaol' }}
                        </button>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Rasmlar</div>
                        @if ($news->images->count())
                            <div class="d-flex flex-wrap gap-3">
                                @foreach ($news->images as $image)
                                    <div class="position-relative">
                                        <a href="{{ asset('storage/' . $image->image) }}" target="_blank" rel="noopener noreferrer">
                                            <img src="{{ asset('storage/' . $image->image) }}" alt="News image"
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
                            <span class="text-body-tertiary">Rasm biriktirilmagan</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-2">Rasm biriktirish</div>
                        <form action="{{ route('admin.images.store') }}" method="POST" enctype="multipart/form-data"
                            class="row g-3">
                            @csrf
                            <input type="hidden" name="news_id" value="{{ $news->id }}">
                            <input type="hidden" name="is_active" value="1">
                            <div class="col-md-10">
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                                    accept=".jpg,.jpeg,.png,.webp" required>
                                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">Biriktirish</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
