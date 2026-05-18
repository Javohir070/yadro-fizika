@extends('layouts.admin')

@section('content')
    @include('admin.laboratory.partials.lang-tab-styles')

    @include('admin.components.navbar_top', ['maniUrl' => 'Mehnat faoliyati tahrirlash'])

    <div class="mb-9">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <div>
                <h3 class="mb-1 fw-semibold">Mehnat faoliyati — tahrirlash</h3>
                <p class="text-body-tertiary mb-0 fs-9">{{ $team->full_name_uz }} · {{ $laboratory->name_uz }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.laboratories.teams.work-activities.show', [$laboratory, $team, $workActivity]) }}"
                    class="btn btn-outline-info btn-sm">Ko'rish</a>
                <a href="{{ route('admin.laboratories.teams.show', [$laboratory, $team]) }}" class="btn btn-secondary">Orqaga</a>
            </div>
        </div>

        @include('admin.components.session')
        @include('admin.laboratory.partials.errors')

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form action="{{ route('admin.laboratories.teams.work-activities.update', [$laboratory, $team, $workActivity]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('admin.laboratory.work-activities._form', ['workActivity' => $workActivity])

                    <div class="mt-4 d-flex gap-2 justify-content-end">
                        <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2">
                            <i data-feather="save" class="w-4 h-4"></i>
                            <span>Yangilash</span>
                        </button>
                        <a href="{{ route('admin.laboratories.teams.show', [$laboratory, $team]) }}" class="btn btn-outline-secondary">Bekor qilish</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
