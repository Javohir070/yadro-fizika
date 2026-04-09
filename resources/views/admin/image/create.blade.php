@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0">Rasm qo'shish</h3>
        <a href="{{ route('admin.images.index') }}" class="btn btn-secondary">Orqaga</a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('admin.images.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label">Yangilik *</label>
                        <select name="news_id" class="form-select @error('news_id') is-invalid @enderror">
                            @foreach ($news as $item)
                                <option value="{{ $item->id }}" {{ old('news_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->title_uz }}
                                </option>
                            @endforeach
                        </select>
                        @error('news_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Rasm *</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" required>
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Holati *</label>
                        <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">
                            <option value="1">Aktiv</option>
                            <option value="0">Nofaol</option>
                        </select>
                        @error('is_active') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2 justify-content-end">
                    <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2">
                            <i data-feather="save" class="w-4 h-4"></i>
                            <span>Saqlash</span>
                        </button>
                    <a href="{{ route('admin.images.index') }}" class="btn btn-outline-secondary">Bekor qilish</a>
                </div>
            </form>
        </div>
    </div>
@endsection
