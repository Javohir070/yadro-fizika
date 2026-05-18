@extends('layouts.admin')

@section('content')
    @include('admin.components.navbar_top', ['maniUrl' => 'Mehnat faoliyati'])

    <div class="mb-9">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <div>
                <h3 class="mb-1 fw-semibold">Mehnat faoliyati</h3>
                <p class="text-body-tertiary mb-0 fs-9">{{ $team->full_name_uz }} · {{ $laboratory->name_uz }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.laboratories.teams.work-activities.edit', [$laboratory, $team, $workActivity]) }}"
                    class="btn btn-warning">Tahrirlash</a>
                <a href="{{ route('admin.laboratories.teams.show', [$laboratory, $team]) }}" class="btn btn-secondary">Orqaga</a>
            </div>
        </div>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="p-3 rounded border">
                            <div class="text-body-tertiary fs-9 mb-1">Holati</div>
                            <span class="badge rounded-pill {{ $workActivity->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $workActivity->is_active ? 'Aktiv' : 'Nofaol' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="p-3 rounded border">
                            <div class="text-body-tertiary fs-9 mb-2">Tafsilot (UZ)</div>
                            <div>{!! $workActivity->details_uz !!}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded border">
                            <div class="text-body-tertiary fs-9 mb-2">Tafsilot (RU)</div>
                            <div>{!! $workActivity->details_ru !!}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded border">
                            <div class="text-body-tertiary fs-9 mb-2">Tafsilot (EN)</div>
                            <div>{!! $workActivity->details_en !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
