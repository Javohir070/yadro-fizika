@extends('layouts.admin')

@section('content')
    @include('admin.components.navbar_top', ['maniUrl' => 'Kengash a\'zosi'])

    <div class="mb-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0 fw-semibold">Kengash a'zosi ma'lumotlari</h2>
            <a href="{{ route('admin.council-members.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2">
                <i data-feather="arrow-left" class="w-4 h-4"></i>
                <span>Orqaga</span>
            </a>
        </div>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-4">
                        <img src="{{ asset('storage/' . $councilMember->photo) }}" alt="{{ $councilMember->full_name_uz }}"
                            class="img-fluid rounded border">
                    </div>
                    <div class="col-md-8">
                        <div class="mb-3">
                            <h5 class="mb-1">Ilmiy kengash</h5>
                            <p class="mb-0">{{ $councilMember->scientificCouncil?->title_uz }}</p>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <h6 class="mb-1">F.I.Sh</h6>
                            <p class="mb-1"><strong>UZ:</strong> {{ $councilMember->full_name_uz }}</p>
                            <p class="mb-1"><strong>RU:</strong> {{ $councilMember->full_name_ru }}</p>
                            <p class="mb-0"><strong>EN:</strong> {{ $councilMember->full_name_en }}</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="mb-1">Lavozim</h6>
                            <p class="mb-1"><strong>UZ:</strong> {{ $councilMember->position_uz }}</p>
                            <p class="mb-1"><strong>RU:</strong> {{ $councilMember->position_ru }}</p>
                            <p class="mb-0"><strong>EN:</strong> {{ $councilMember->position_en }}</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="mb-1">Ilmiy daraja</h6>
                            <p class="mb-1"><strong>UZ:</strong> {{ $councilMember->degree_uz }}</p>
                            <p class="mb-1"><strong>RU:</strong> {{ $councilMember->degree_ru }}</p>
                            <p class="mb-0"><strong>EN:</strong> {{ $councilMember->degree_en }}</p>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-secondary">Tartib: {{ $councilMember->order }}</span>
                            <span class="badge {{ $councilMember->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $councilMember->is_active ? 'Aktiv' : 'Nofaol' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
