<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2 mt-2">
    <h6 class="fw-semibold mb-0">Mehnat faoliyati</h6>
    <a href="{{ route('admin.laboratories.teams.work-activities.create', [$laboratory, $team]) }}"
        class="btn btn-primary btn-sm d-inline-flex align-items-center gap-2">
        <i data-feather="plus" class="w-4 h-4"></i>
        <span>Qo'shish</span>
    </a>
</div>

<div class="border border-translucent rounded-3 overflow-hidden bg-body-emphasis">
    <div class="table-responsive">
        <table class="table table-report align-middle mb-0">
            <thead class="bg-body-secondary bg-opacity-50">
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Tafsilot (UZ)</th>
                    <th style="width: 100px;">Holati</th>
                    <th class="text-end pe-3" style="width: 140px;">Amallar</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($team->workActivities as $activity)
                    <tr>
                        <td class="text-center text-body-tertiary">{{ $loop->iteration }}</td>
                        <td>{!! \Illuminate\Support\Str::limit(strip_tags($activity->details_uz), 100) !!}</td>
                        <td>
                            <span class="badge rounded-pill {{ $activity->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $activity->is_active ? 'Aktiv' : 'Nofaol' }}
                            </span>
                        </td>
                        <td class="text-end pe-3">
                            <div class="d-inline-flex align-items-center gap-1">
                                <a href="{{ route('admin.laboratories.teams.work-activities.show', [$laboratory, $team, $activity]) }}"
                                    class="btn btn-sm btn-outline-success" title="Ko'rish">
                                    <i data-feather="eye" class="w-4 h-4"></i>
                                </a>
                                <a href="{{ route('admin.laboratories.teams.work-activities.edit', [$laboratory, $team, $activity]) }}"
                                    class="btn btn-sm btn-outline-primary" title="Tahrirlash">
                                    <i data-feather="edit" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('admin.laboratories.teams.work-activities.destroy', [$laboratory, $team, $activity]) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="O'chirish"
                                        onclick="return confirm('Mehnat faoliyati o\'chirilsinmi?')">
                                        <i data-feather="trash" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-body-tertiary">
                            Mehnat faoliyati qo'shilmagan.
                            <div class="mt-2">
                                <a href="{{ route('admin.laboratories.teams.work-activities.create', [$laboratory, $team]) }}"
                                    class="btn btn-primary btn-sm">Qo'shish</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
