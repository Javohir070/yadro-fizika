@extends('layouts.admin')
@section('content')
    @include('admin.components.navbar_top', ['maniUrl' => 'Dashboard statistikasi'])

    @php
        $sectionsCount = $stats->count();
        $allRecords = $stats->sum('total');
        $activeRecords = $stats->sum(fn ($item) => $item['active'] ?? 0);
        $inactiveRecords = $stats->sum(fn ($item) => $item['inactive'] ?? 0);
        $sortedStats = $stats->sortByDesc('total')->values();
    @endphp

    <style>
        .dashboard-stat-card {
            border: 1px solid rgba(148, 163, 184, 0.15);
            background-color: var(--phoenix-card-bg, var(--bs-card-bg));
            color: var(--phoenix-body-color, var(--bs-body-color));
            transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease,
                background-color 0.18s ease;
        }

        .dashboard-stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.75rem 1.5rem rgba(15, 23, 42, 0.08) !important;
            border-color: rgba(59, 130, 246, 0.25);
        }

        .dashboard-mini-card {
            border: 1px solid rgba(148, 163, 184, 0.18);
            background: linear-gradient(180deg, rgba(248, 250, 252, 0.8) 0%, rgba(241, 245, 249, 0.5) 100%);
            color: var(--phoenix-body-color, var(--bs-body-color));
        }

        .dashboard-search {
            max-width: 420px;
        }

        .dashboard-progress {
            height: 8px;
            background-color: rgba(100, 116, 139, 0.12);
            border-radius: 999px;
            overflow: hidden;
        }

        .dashboard-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #22c55e 0%, #4ade80 100%);
            border-radius: 999px;
            transition: width 0.2s ease;
        }

        [data-bs-theme="dark"] .dashboard-stat-card {
            border-color: rgba(203, 208, 221, 0.18);
            background-color: #141824;
            box-shadow: 0 0.125rem 0.5rem rgba(0, 0, 0, 0.22) !important;
        }

        [data-bs-theme="dark"] .dashboard-stat-card:hover {
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.34) !important;
            border-color: rgba(56, 116, 255, 0.48);
        }

        [data-bs-theme="dark"] .dashboard-mini-card {
            border-color: rgba(203, 208, 221, 0.16);
            background: linear-gradient(180deg, rgba(20, 24, 36, 0.96) 0%, rgba(17, 20, 30, 0.96) 100%);
        }

        [data-bs-theme="dark"] .dashboard-search .form-control {
            border-color: rgba(203, 208, 221, 0.22);
            background-color: #141824;
            color: #e3e6ed;
        }

        [data-bs-theme="dark"] .dashboard-search .form-control::placeholder {
            color: #9fa6bc;
        }

        [data-bs-theme="dark"] .dashboard-progress {
            background-color: rgba(203, 208, 221, 0.16);
        }

        [data-bs-theme="dark"] .dashboard-progress-bar {
            background: linear-gradient(90deg, #25b003 0%, #46d36b 100%);
        }
    </style>

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <div>
            <h3 class="mb-1">Bo'limlar statistikasi</h3>
            <p class="text-body-tertiary mb-0">Barcha admin bo'limlar bo'yicha tezkor holat</p>
        </div>
        <div class="dashboard-search w-100">
            <input type="search" id="dashboardSectionSearch" class="form-control"
                placeholder="Bo'lim nomi bo'yicha qidirish...">
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-md-6 col-xl-3">
            <div class="dashboard-mini-card rounded-3 p-3 h-100">
                <div class="text-body-tertiary small mb-1">Bo'limlar soni</div>
                <div class="fs-4 fw-bold">{{ $sectionsCount }}</div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="dashboard-mini-card rounded-3 p-3 h-100">
                <div class="text-body-tertiary small mb-1">Jami yozuvlar</div>
                <div class="fs-4 fw-bold">{{ $allRecords }}</div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="dashboard-mini-card rounded-3 p-3 h-100">
                <div class="text-body-tertiary small mb-1">Aktiv yozuvlar</div>
                <div class="fs-4 fw-bold text-success">{{ $activeRecords }}</div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="dashboard-mini-card rounded-3 p-3 h-100">
                <div class="text-body-tertiary small mb-1">Nofaol yozuvlar</div>
                <div class="fs-4 fw-bold text-secondary">{{ $inactiveRecords }}</div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        @foreach ($sortedStats as $item)
            @php
                $activePercent = null;
                if (!is_null($item['active']) && $item['total'] > 0) {
                    $activePercent = (int) round(($item['active'] / $item['total']) * 100);
                }
            @endphp
            <div class="col-12 col-md-6 col-xl-4 dashboard-stat-item" data-label="{{ \Illuminate\Support\Str::lower($item['label']) }}">
                <a href="{{ route($item['route']) }}" class="text-decoration-none text-reset">
                    <div class="card dashboard-stat-card h-100 shadow-sm border-0 rounded-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h6 class="mb-0 fw-semibold">{{ $item['label'] }}</h6>
                                <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">
                                    Jami: {{ $item['total'] }}
                                </span>
                            </div>

                            @if (!is_null($item['active']))
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge rounded-pill bg-success-subtle text-success px-3 py-2">
                                        Aktiv: {{ $item['active'] }}
                                    </span>
                                    <span class="badge rounded-pill bg-secondary-subtle text-secondary px-3 py-2">
                                        Nofaol: {{ $item['inactive'] }}
                                    </span>
                                </div>
                                <div class="small text-body-tertiary mb-1">Aktiv ulushi: {{ $activePercent }}%</div>
                                <div class="dashboard-progress">
                                    <div class="dashboard-progress-bar" @style(['width' => $activePercent . '%'])></div>
                                </div>
                            @else
                                <span class="text-body-tertiary small">Bu bo'limda aktiv/nofaol mavjud emas.</span>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <script>
        (function() {
            const searchInput = document.getElementById('dashboardSectionSearch');
            const cards = Array.from(document.querySelectorAll('.dashboard-stat-item'));

            if (!searchInput || !cards.length) {
                return;
            }

            searchInput.addEventListener('input', function() {
                const keyword = this.value.trim().toLowerCase();

                cards.forEach((card) => {
                    const label = card.dataset.label || '';
                    const matched = keyword === '' || label.includes(keyword);
                    card.classList.toggle('d-none', !matched);
                });
            });
        })();
    </script>
@endsection
