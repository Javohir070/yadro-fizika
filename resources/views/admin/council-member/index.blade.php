@extends('layouts.admin')

@section('content')
    @include('admin.components.navbar_top', ['maniUrl' => 'Kengash a\'zolari'])

    <div class="mb-9">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <h2 class="mb-0 fw-semibold">Kengash a'zolari</h2>
            <a href="{{ route('admin.council-members.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2">
                <i data-feather="plus" class="w-4 h-4"></i>
                <span>Qo'shish</span>
            </a>
        </div>

        @include('admin.components.session')

        <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1 pt-4 pb-4">
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report mt-2">
                    <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>F.I.Sh (UZ)</th>
                            <th>Ilmiy kengash</th>
                            <th>Tartib</th>
                            <th>Rasm</th>
                            <th>Holati</th>
                            <th class="text-end pe-8">Amallar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($councilMembers as $member)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $member->full_name_uz }}</td>
                                <td>{{ $member->scientificCouncil?->title_uz }}</td>
                                <td><span class="badge bg-secondary">{{ $member->order }}</span></td>
                                <td>
                                    <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->full_name_uz }}"
                                        style="width: 70px; height: 50px; object-fit: cover;" class="rounded border">
                                </td>
                                <td>
                                    <button type="button"
                                        class="btn btn-sm rounded-pill {{ $member->is_active ? 'btn-success' : 'btn-secondary' }}"
                                        disabled>
                                        {{ $member->is_active ? 'Aktiv' : 'Nofaol' }}
                                    </button>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex align-items-center gap-2">
                                        <a href="{{ route('admin.council-members.show', $member) }}" class="btn btn-outline-success" style="display:inline-block;padding:8px;">
                                            <i data-feather="eye" class="w-4 h-4"></i>
                                        </a>
                                        <a href="{{ route('admin.council-members.edit', $member) }}" class="btn btn-outline-primary" style="display:inline-block;padding:8px;">
                                            <i data-feather="edit" class="w-4 h-4"></i>
                                        </a>
                                        <form action="{{ route('admin.council-members.destroy', $member) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-outline-danger d-inline-flex align-items-center justify-content-center"
                                                style="width: 36px; height: 36px;"
                                                onclick="return confirm('Kengash a\'zosi o\'chirilsinmi?')">
                                                <span class="w-5 h-5 flex items-center justify-center">
                                                    <i data-feather="trash" class="w-4 h-4"></i>
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <a href="{{ route('admin.council-members.create') }}" class="btn btn-primary btn-sm">Birinchi a'zoni qo'shish</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-transparent border-0 pt-3 pb-3 d-flex justify-content-center">
            {{ $councilMembers->links() }}
        </div>
    </div>
@endsection
