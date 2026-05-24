@extends('layouts.admin')

@section('content')

    @include('admin.components.navbar_top', ['maniUrl' => $team->full_name_uz])

    <div class="mb-9">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <div>
                <h3 class="mb-1 fw-semibold">{{ $team->full_name_uz }}</h3>
                <p class="text-body-tertiary mb-0 fs-9">{{ $laboratory->name_uz }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.laboratories.teams.edit', [$laboratory, $team]) }}"
                    class="btn btn-warning">Tahrirlash</a>
                <a href="{{ route('admin.laboratories.edit', ['laboratory' => $laboratory, 'tab' => 'team']) }}"
                    class="btn btn-secondary">Orqaga</a>
            </div>
        </div>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-lg-4">
                        <div class="p-3 rounded border bg-body-secondary h-100">
                            <div class="text-body-tertiary fs-9 mb-2">Rasm</div>
                            @if ($team->image_url)
                                <div class="rounded overflow-hidden border bg-white d-flex justify-content-center">
                                    <img src="{{ $team->image_url }}" alt="{{ $team->full_name_uz }}" class="img-fluid w-100"
                                        style="max-height: 320px; object-fit: cover;">
                                </div>
                            @else
                                <div class="rounded border bg-white d-flex align-items-center justify-content-center text-body-tertiary"
                                    style="min-height: 200px;">
                                    Rasm mavjud emas
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="p-3 rounded border">
                                    <div class="text-body-tertiary fs-9 mb-1">Tartib</div>
                                    <span class="badge bg-secondary">{{ $team->order }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 rounded border">
                                    <div class="text-body-tertiary fs-9 mb-1">Laboratoriya mudiri</div>
                                    <button type="button"
                                        class="btn btn-sm rounded-pill {{ $team->isLaboratoryDirector() ? 'btn-primary' : 'btn-secondary' }}"
                                        disabled>
                                        {{ $team->isLaboratoryDirector() ? 'Ha' : 'Yo\'q' }}
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 rounded border">
                                    <div class="text-body-tertiary fs-9 mb-1">Holati</div>
                                    <button type="button"
                                        class="btn btn-sm rounded-pill {{ $team->is_active ? 'btn-success' : 'btn-secondary' }}"
                                        disabled>
                                        {{ $team->is_active ? 'Aktiv' : 'Nofaol' }}
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="p-3 rounded border">
                                    <div class="text-body-tertiary fs-9 mb-1">Lavozim (UZ)</div>
                                    <div class="fw-semibold">{{ $team->position_uz }}</div>
                                </div>
                            </div>
                            @if ($team->degree_uz)
                                <div class="col-md-12">
                                    <div class="p-3 rounded border">
                                        <div class="text-body-tertiary fs-9 mb-1">Ilmiy daraja / unvon (UZ)</div>
                                        <div>{!! nl2br(e($team->degree_uz)) !!}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 rounded border bg-body-secondary">
                            <div class="text-body-tertiary fs-9 mb-1">F.I.Sh (UZ)</div>
                            <div class="fw-semibold">{{ $team->full_name_uz }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 rounded border bg-body-secondary">
                            <div class="text-body-tertiary fs-9 mb-1">F.I.Sh (RU)</div>
                            <div class="fw-semibold">{{ $team->full_name_ru }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 rounded border bg-body-secondary">
                            <div class="text-body-tertiary fs-9 mb-1">F.I.Sh (EN)</div>
                            <div class="fw-semibold">{{ $team->full_name_en }}</div>
                        </div>
                    </div>

                    @php
                        $profiles = [
                            'Google Scholar' => $team->google_scholar,
                            'Web of Science' => $team->web_of_science,
                            'Scopus' => $team->scopus,
                            'ResearchGate' => $team->researchgate,
                            'ORCID' => $team->orcid,
                        ];
                    @endphp
                    @if (collect($profiles)->filter()->isNotEmpty())
                        <div class="col-12">
                            <h6 class="fw-semibold mb-2">Ilmiy profillar</h6>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($profiles as $label => $url)
                                    @if ($url)
                                        <a href="{{ $url }}" target="_blank" rel="noopener noreferrer"
                                            class="btn btn-sm btn-outline-primary">{{ $label }}</a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @include('admin.components.session')

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                @include('admin.laboratory.partials.team-work-activities')
            </div>
        </div>
    </div>
@endsection
