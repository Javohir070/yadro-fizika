@extends('layouts.admin')

@section('content')
    @include('admin.components.navbar_top', ['maniUrl' => 'Konferensiya tafsiloti'])

    <style>
        .show-rich-text {
            font-size: 0.95rem;
            line-height: 1.55;
            word-break: break-word;
        }

        .show-rich-text img,
        .show-rich-text video,
        .show-rich-text iframe {
            max-width: 100%;
            height: auto;
        }

        .show-rich-text table {
            max-width: 100%;
        }

        .show-rich-text-scroll {
            max-height: min(70vh, 520px);
            overflow: auto;
        }
    </style>

    @include('admin.components.session')

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <div>
            <h3 class="mb-0 fw-semibold">Konferensiya</h3>
            <div class="text-body-tertiary fs-9 mt-1">ID: {{ $conference->id }}</div>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('admin.conferences.edit', $conference) }}" class="btn btn-warning">Tahrirlash</a>
            <a href="{{ route('admin.conferences.index') }}" class="btn btn-secondary">Orqaga</a>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-12">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-2">Rasmlar ({{ $conference->images->count() }})</div>
                        @if ($conference->images->isNotEmpty())
                            <div class="d-flex flex-wrap gap-3">
                                @foreach ($conference->images as $image)
                                    <div class="position-relative">
                                        <a href="{{ asset('storage/' . $image->image) }}" target="_blank" rel="noopener noreferrer">
                                            <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $conference->title_uz }}"
                                                class="rounded border" style="width: 160px; height: 110px; object-fit: cover;">
                                        </a>
                                        <form action="{{ route('admin.conferences.images.destroy', [$conference, $image]) }}"
                                            method="POST" class="position-absolute top-0 end-0 m-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger p-1"
                                                onclick="return confirm('Rasm o\'chirilsinmi?')"
                                                style="line-height: 1;" title="Rasmni o'chirish">
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

                <div class="col-12">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Rasm biriktirish</div>
                        <form action="{{ route('admin.conferences.images.store', $conference) }}" method="POST"
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

                <div class="col-12">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Fayllar ({{ $conference->files->count() }})</div>
                        @if ($conference->files->isNotEmpty())
                            <div class="d-flex flex-column gap-2">
                                @foreach ($conference->files as $file)
                                    <div class="d-flex align-items-center justify-content-between gap-2 p-2 rounded border bg-body-secondary">
                                        <a href="{{ asset('storage/' . $file->file) }}" target="_blank" rel="noopener noreferrer">
                                            {{ $file->displayName() }}
                                        </a>
                                        <form action="{{ route('admin.conferences.files.destroy', [$conference, $file]) }}"
                                            method="POST" class="mb-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger p-1"
                                                onclick="return confirm('Fayl o\'chirilsinmi?')"
                                                title="Faylni o'chirish" style="line-height: 1;">
                                                <i data-feather="x" class="w-3 h-3"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <span class="text-body-tertiary">Fayl biriktirilmagan</span>
                        @endif
                    </div>
                </div>

                <div class="col-12">
                    <div class="p-3 rounded border bg-body-secondary">
                        <div class="text-body-tertiary fs-9 mb-2">Fayl biriktirish</div>
                        <form action="{{ route('admin.conferences.files.store', $conference) }}" method="POST"
                            enctype="multipart/form-data" class="row g-3">
                            @csrf
                            <div class="col-md-10">
                                <input type="file" name="files[]" multiple
                                    class="form-control @error('files') is-invalid @enderror @error('files.*') is-invalid @enderror"
                                    accept=".pdf,.doc,.docx" required>
                                @error('files') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                @error('files.*') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">Biriktirish</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary h-100">
                        <div class="text-body-tertiary fs-9 mb-1">Sarlavha (UZ)</div>
                        <div class="fw-semibold">{{ $conference->title_uz }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary h-100">
                        <div class="text-body-tertiary fs-9 mb-1">Sarlavha (RU)</div>
                        <div class="fw-semibold">{{ $conference->title_ru }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border bg-body-secondary h-100">
                        <div class="text-body-tertiary fs-9 mb-1">Sarlavha (EN)</div>
                        <div class="fw-semibold">{{ $conference->title_en }}</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 rounded border h-100">
                        <div class="text-body-tertiary fs-9 mb-1">Joy (UZ)</div>
                        <div>{{ $conference->location_uz }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border h-100">
                        <div class="text-body-tertiary fs-9 mb-1">Joy (RU)</div>
                        <div>{{ $conference->location_ru }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded border h-100">
                        <div class="text-body-tertiary fs-9 mb-1">Joy (EN)</div>
                        <div>{{ $conference->location_en }}</div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="p-3 rounded border h-100">
                        <div class="text-body-tertiary fs-9 mb-2">Boshlanish</div>
                        <div class="fw-semibold">{{ $conference->start_date?->format('d.m.Y') ?? '—' }}</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 rounded border h-100">
                        <div class="text-body-tertiary fs-9 mb-2">Tugash</div>
                        <div class="fw-semibold">{{ $conference->end_date?->format('d.m.Y') ?? '—' }}</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 rounded border h-100">
                        <div class="text-body-tertiary fs-9 mb-2">Tartib</div>
                        <span class="badge bg-secondary fs-8">{{ $conference->order }}</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 rounded border h-100">
                        <div class="text-body-tertiary fs-9 mb-2">Holati</div>
                        <button type="button"
                            class="btn btn-sm rounded-pill {{ $conference->is_active ? 'btn-success' : 'btn-secondary' }}"
                            disabled>
                            {{ $conference->is_active ? 'Aktiv' : 'Nofaol' }}
                        </button>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 rounded border h-100">
                        <div class="text-body-tertiary fs-9 mb-1">Yaratilgan</div>
                        <div class="small">{{ $conference->created_at?->format('d.m.Y H:i') ?? '—' }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 rounded border h-100">
                        <div class="text-body-tertiary fs-9 mb-1">Yangilangan</div>
                        <div class="small">{{ $conference->updated_at?->format('d.m.Y H:i') ?? '—' }}</div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="p-3 rounded border">
                        <div class="text-body-tertiary fs-9 mb-2">Matn (UZ)</div>
                        @if (filled(strip_tags($conference->description_uz ?? '')))
                            <div class="show-rich-text show-rich-text-scroll border rounded p-3 bg-body-secondary bg-opacity-25">
                                {!! $conference->description_uz !!}
                            </div>
                        @else
                            <span class="text-body-tertiary">—</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 rounded border h-100">
                        <div class="text-body-tertiary fs-9 mb-2">Matn (RU)</div>
                        @if (filled(strip_tags($conference->description_ru ?? '')))
                            <div class="show-rich-text show-rich-text-scroll border rounded p-3 bg-body-secondary bg-opacity-25">
                                {!! $conference->description_ru !!}
                            </div>
                        @else
                            <span class="text-body-tertiary">—</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 rounded border h-100">
                        <div class="text-body-tertiary fs-9 mb-2">Matn (EN)</div>
                        @if (filled(strip_tags($conference->description_en ?? '')))
                            <div class="show-rich-text show-rich-text-scroll border rounded p-3 bg-body-secondary bg-opacity-25">
                                {!! $conference->description_en !!}
                            </div>
                        @else
                            <span class="text-body-tertiary">—</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
