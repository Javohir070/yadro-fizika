@extends('layouts.admin')

@section('content')
    @include('admin.laboratory.partials.lang-tab-styles')

    @include('admin.components.navbar_top', ['maniUrl' => 'Jamoa a\'zosi qo\'shish'])

    <div class="mb-9">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <div>
                <h3 class="mb-1 fw-semibold">Jamoa a'zosi — qo'shish</h3>
                <p class="text-body-tertiary mb-0 fs-9">{{ $laboratory->name_uz }}</p>
            </div>
            <a href="{{ route('admin.laboratories.edit', ['laboratory' => $laboratory, 'tab' => 'team']) }}"
                class="btn btn-secondary">Orqaga</a>
        </div>

        @include('admin.components.session')
        @include('admin.laboratory.partials.errors')

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form action="{{ route('admin.laboratories.teams.store', $laboratory) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @include('admin.laboratory.teams._form')

                    <div class="mt-4 d-flex gap-2 justify-content-end">
                        <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2">
                            <i data-feather="save" class="w-4 h-4"></i>
                            <span>Saqlash</span>
                        </button>
                        <a href="{{ route('admin.laboratories.edit', ['laboratory' => $laboratory, 'tab' => 'team']) }}"
                            class="btn btn-outline-secondary">Bekor qilish</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
