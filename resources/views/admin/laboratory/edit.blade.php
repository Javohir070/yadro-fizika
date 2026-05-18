@extends('layouts.admin')

@section('content')
    @include('admin.laboratory.partials.lang-tab-styles')

    <style>
        .laboratory-section-tabs .nav-link {
            color: var(--phoenix-body-color);
            border-radius: 0.5rem;
            padding: 0.65rem 1rem;
        }

        .laboratory-section-tabs .nav-link.active {
            background-color: #ede9fe;
            color: #5b21b6;
        }
    </style>

    @include('admin.components.navbar_top', ['maniUrl' => $laboratory->name_uz])

    <div class="mb-9">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
            <div>
                <h2 class="mb-1 fw-semibold">{{ $laboratory->name_uz }}</h2>
                <p class="text-body-tertiary mb-0 fs-9">Laboratoriyani boshqarish — barcha bo'limlar bir joyda</p>
            </div>
            <a href="{{ route('admin.laboratories.index') }}" class="btn btn-secondary">Ro'yxatga qaytish</a>
        </div>

        @include('admin.components.session')
        @include('admin.laboratory.partials.errors')

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                @include('admin.laboratory.partials.section-tabs')

                @if ($tab === 'about')
                    @include('admin.laboratory.partials.tab-about')
                @elseif ($tab === 'team')
                    @include('admin.laboratory.partials.tab-team')
                @elseif ($tab === 'scientific')
                    @include('admin.laboratory.partials.tab-scientific')
                @elseif ($tab === 'international')
                    @include('admin.laboratory.partials.tab-international')
                @endif
            </div>
        </div>
    </div>
@endsection
