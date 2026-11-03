@extends('layouts.admin')

@section('content')
    @include('admin.components.navbar_top', ['maniUrl' => 'Ijtimoiy tarmoqlar'])

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0">Ijtimoiy tarmoqlar</h3>
    </div>

    @include('admin.components.session')

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('admin.social-links.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">YouTube</label>
                        <input type="url" name="youtube_url" value="{{ old('youtube_url', $socialLink->youtube_url) }}"
                            class="form-control @error('youtube_url') is-invalid @enderror"
                            placeholder="https://www.youtube.com/...">
                        @error('youtube_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Telegram</label>
                        <input type="url" name="telegram_url" value="{{ old('telegram_url', $socialLink->telegram_url) }}"
                            class="form-control @error('telegram_url') is-invalid @enderror"
                            placeholder="https://t.me/...">
                        @error('telegram_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Instagram</label>
                        <input type="url" name="instagram_url" value="{{ old('instagram_url', $socialLink->instagram_url) }}"
                            class="form-control @error('instagram_url') is-invalid @enderror"
                            placeholder="https://www.instagram.com/...">
                        @error('instagram_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Facebook</label>
                        <input type="url" name="facebook_url" value="{{ old('facebook_url', $socialLink->facebook_url) }}"
                            class="form-control @error('facebook_url') is-invalid @enderror"
                            placeholder="https://www.facebook.com/...">
                        @error('facebook_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2 justify-content-end">
                    <button type="submit" class="btn btn-primary">Saqlash</button>
                </div>
            </form>
        </div>
    </div>
@endsection
