<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h5 class="mb-1 fw-semibold">Laboratoriya tarkibi</h5>
        <p class="text-body-tertiary mb-0 fs-9">Jamoa a'zolarini boshqaring</p>
    </div>
    <a href="{{ route('admin.laboratories.teams.create', $laboratory) }}"
        class="btn btn-primary d-inline-flex align-items-center gap-2">
        <i data-feather="plus" class="w-4 h-4"></i>
        <span>A'zo qo'shish</span>
    </a>
</div>

<div class="border border-translucent rounded-3 overflow-hidden bg-body-emphasis">
    <div class="table-responsive">
        <table class="table table-report align-middle mb-0">
            <thead class="bg-body-secondary bg-opacity-50">
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th style="width: 72px;">Rasm</th>
                    <th>F.I.Sh (UZ)</th>
                    <th>Lavozim (UZ)</th>
                    <th style="width: 80px;">Tartib</th>
                    <th style="width: 100px;">Holati</th>
                    <th class="text-end pe-4" style="width: 140px;">Amallar</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laboratory->teams as $member)
                    <tr>
                        <td class="text-center text-body-tertiary">{{ $loop->iteration }}</td>
                        <td>
                            @if ($member->image_url)
                                <img src="{{ $member->image_url }}" alt="{{ $member->full_name_uz }}"
                                    class="rounded border" style="width: 48px; height: 48px; object-fit: cover;">
                            @else
                                <div class="rounded border bg-body-secondary d-flex align-items-center justify-content-center text-body-tertiary"
                                    style="width: 48px; height: 48px;">
                                    <i data-feather="user" style="width: 18px; height: 18px;"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-semibold text-nowrap">{{ $member->full_name_uz }}</td>
                        <td class="text-body-secondary">{{ \Illuminate\Support\Str::limit($member->position_uz, 50) }}</td>
                        <td><span class="badge bg-secondary">{{ $member->order }}</span></td>
                        <td>
                            <span class="badge rounded-pill {{ $member->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $member->is_active ? 'Aktiv' : 'Nofaol' }}
                            </span>
                        </td>
                        <td class="text-end pe-3">
                            <div class="d-inline-flex align-items-center gap-1">
                                <a href="{{ route('admin.laboratories.teams.show', [$laboratory, $member]) }}"
                                    class="btn btn-sm btn-outline-success" title="Ko'rish">
                                    <i data-feather="eye" class="w-4 h-4"></i>
                                </a>
                                <a href="{{ route('admin.laboratories.teams.edit', [$laboratory, $member]) }}"
                                    class="btn btn-sm btn-outline-primary" title="Tahrirlash">
                                    <i data-feather="edit" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('admin.laboratories.teams.destroy', [$laboratory, $member]) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="O'chirish"
                                        onclick="return confirm('Jamoa a\'zosi o\'chirilsinmi?')">
                                        <i data-feather="trash" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="text-body-tertiary mb-3">Hali jamoa a'zolari qo'shilmagan.</div>
                            <a href="{{ route('admin.laboratories.teams.create', $laboratory) }}"
                                class="btn btn-primary btn-sm d-inline-flex align-items-center gap-2">
                                <i data-feather="plus" class="w-4 h-4"></i>
                                <span>Birinchi a'zoni qo'shish</span>
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
