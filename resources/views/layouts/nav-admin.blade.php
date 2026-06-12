@can('Bosh sahifa')
<li class="nav-item">
    <div class="nav-item-wrapper">
        <a class="nav-link label-1 {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home.index') }}"
            role="button" data-bs-toggle="" aria-expanded="false">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <span data-feather="home" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">Bosh sahifa</span>
                </span>
            </div>
        </a>
    </div>
</li>
@endcan

@can('Bannerlar')
<li class="nav-item">
    <div class="nav-item-wrapper">
        <a class="nav-link label-1 {{ request()->is('admin/banners*') ? 'active' : '' }}"
            href="{{ route('admin.banners.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <span data-feather="layout" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">Bannerlar</span>
                </span>
            </div>
        </a>
    </div>
</li>
@endcan

@can('E\'lonlar')
<li class="nav-item">
    <div class="nav-item-wrapper">
        <a class="nav-link label-1 {{ request()->is('admin/ads*') ? 'active' : '' }}"
            href="{{ route('admin.ads.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <span data-feather="sidebar" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">E'lonlar</span>
                </span>
            </div>
        </a>
    </div>
</li>
@endcan

@can('Konferensiyalar')
<li class="nav-item">
    <div class="nav-item-wrapper">
        <a class="nav-link label-1 {{ request()->is('admin/conferences*') ? 'active' : '' }}"
            href="{{ route('admin.conferences.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <span data-feather="calendar" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">Konferensiyalar</span>
                </span>
            </div>
        </a>
    </div>
</li>
@endcan

@can('About')
<li class="nav-item">
    <div class="nav-item-wrapper">
        <a class="nav-link label-1 {{ request()->is('admin/abouts*') ? 'active' : '' }}"
            href="{{ route('admin.abouts.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <span data-feather="info" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">About</span>
                </span>
            </div>
        </a>
    </div>
</li>
@endcan

@can('Institut tarixi')
<li class="nav-item">
    <div class="nav-item-wrapper">
        <a class="nav-link label-1 {{ request()->is('admin/institute-histories*') ? 'active' : '' }}"
            href="{{ route('admin.institute-histories.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <span data-feather="clock" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">Institut tarixi</span>
                </span>
            </div>
        </a>
    </div>
</li>
@endcan

@can('Institut nizomi')
<li class="nav-item">
    <div class="nav-item-wrapper">
        <a class="nav-link label-1 {{ request()->is('admin/charters*') ? 'active' : '' }}"
            href="{{ route('admin.charters.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <span data-feather="file-text" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">Institut nizomi</span>
                </span>
            </div>
        </a>
    </div>
</li>
@endcan

@can('Institut direktorlari')
<li class="nav-item">
    <div class="nav-item-wrapper">
        <a class="nav-link label-1 {{ request()->is('admin/institute-directors*') ? 'active' : '' }}"
            href="{{ route('admin.institute-directors.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <span data-feather="user" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">Institut direktorlari</span>
                </span>
            </div>
        </a>
    </div>
</li>
@endcan

@can('Institut tuzilmasi')
<li class="nav-item">
    <div class="nav-item-wrapper">
        <a class="nav-link label-1 {{ request()->is('admin/institute-structures*') ? 'active' : '' }}"
            href="{{ route('admin.institute-structures.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <span data-feather="layers" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">Institut tuzilmasi</span>
                </span>
            </div>
        </a>
    </div>
</li>
@endcan

@can('Tashkilot tuzilmasi')
<li class="nav-item">
    <div class="nav-item-wrapper">
        <a class="nav-link label-1 {{ request()->is('admin/structures*') ? 'active' : '' }}"
            href="{{ route('admin.structures.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <span data-feather="git-merge" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">Tashkilot tuzilmasi</span>
                </span>
            </div>
        </a>
    </div>
</li>
@endcan

@can('Laboratoriyalar')
<li class="nav-item">
    <div class="nav-item-wrapper">
        <a class="nav-link label-1 {{ request()->is('admin/laboratories*') ? 'active' : '' }}"
            href="{{ route('admin.laboratories.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <span data-feather="cpu" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">Laboratoriyalar</span>
                </span>
            </div>
        </a>
    </div>
</li>
@endcan

@can('Bo\'limlar')
<li class="nav-item">
    <div class="nav-item-wrapper">
        <a class="nav-link label-1 {{ request()->is('admin/departments*') ? 'active' : '' }}"
            href="{{ route('admin.departments.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <span data-feather="briefcase" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">Bo'limlar</span>
                </span>
            </div>
        </a>
    </div>
</li>
@endcan

@can('Rahbariyat')
<li class="nav-item">
    <div class="nav-item-wrapper">
        <a class="nav-link label-1 {{ request()->is('admin/leaderships*') ? 'active' : '' }}"
            href="{{ route('admin.leaderships.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <span data-feather="users" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">Rahbariyat</span>
                </span>
            </div>
        </a>
    </div>
</li>
@endcan

@can('Hamkorlar')
<li class="nav-item">
    <div class="nav-item-wrapper">
        <a class="nav-link label-1 {{ request()->is('admin/partners*') ? 'active' : '' }}"
            href="{{ route('admin.partners.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <span data-feather="link" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">Hamkorlar</span>
                </span>
            </div>
        </a>
    </div>
</li>
@endcan

@can('Yangiliklar')
<li class="nav-item">
    <div class="nav-item-wrapper">
        <a class="nav-link label-1 {{ request()->is('admin/news*') ? 'active' : '' }}"
            href="{{ route('admin.news.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <span data-feather="file-text" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">Yangiliklar</span>
                </span>
            </div>
        </a>
    </div>
</li>
@endcan

@can('Galereya')
<li class="nav-item">
    <div class="nav-item-wrapper">
        <a class="nav-link label-1 {{ request()->is('admin/galleries*') ? 'active' : '' }}"
            href="{{ route('admin.galleries.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <span data-feather="image" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">Galereya</span>
                </span>
            </div>
        </a>
    </div>
</li>
@endcan

@can('Video galereya')
<li class="nav-item">
    <div class="nav-item-wrapper">
        <a class="nav-link label-1 {{ request()->is('admin/video-gallers*') ? 'active' : '' }}"
            href="{{ route('admin.video-gallers.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <span data-feather="video" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">Video galereya</span>
                </span>
            </div>
        </a>
    </div>
</li>
@endcan

@can('Statistika bloklari')
<li class="nav-item">
    <div class="nav-item-wrapper">
        <a class="nav-link label-1 {{ request()->is('admin/stats*') ? 'active' : '' }}"
            href="{{ route('admin.stats.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <span data-feather="bar-chart-2" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">Statistika bloklari</span>
                </span>
            </div>
        </a>
    </div>
</li>
@endcan

@can('Doktorantura')
<li class="nav-item">
    <div class="nav-item-wrapper">
        <a class="nav-link label-1 {{ request()->is('admin/doctorals*') ? 'active' : '' }}"
            href="{{ route('admin.doctorals.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <span data-feather="book-open" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">Doktorantura</span>
                </span>
            </div>
        </a>
    </div>
</li>
@endcan

@can('Nashrlar')
<li class="nav-item">
    <div class="nav-item-wrapper">
        <a class="nav-link label-1 {{ request()->is('admin/publications*') ? 'active' : '' }}"
            href="{{ route('admin.publications.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <span data-feather="book" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">Nashrlar</span>
                </span>
            </div>
        </a>
    </div>
</li>
@endcan

@can('Yangiliklar rasmlari')
<li class="nav-item">
    <div class="nav-item-wrapper">
        <a class="nav-link label-1 {{ request()->is('admin/images*') ? 'active' : '' }}"
            href="{{ route('admin.images.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <span data-feather="camera" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">Yangiliklar rasmlari</span>
                </span>
            </div>
        </a>
    </div>
</li>
@endcan

@can('Ilmiy kengash')
<li class="nav-item">
    <div class="nav-item-wrapper">
        <a class="nav-link label-1 {{ request()->is('admin/scientific-councils*') ? 'active' : '' }}"
            href="{{ route('admin.scientific-councils.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <span data-feather="award" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">Ilmiy kengash</span>
                </span>
            </div>
        </a>
    </div>
</li>
@endcan

@can('Kengash a\'zolari')
<li class="nav-item">
    <div class="nav-item-wrapper">
        <a class="nav-link label-1 {{ request()->is('admin/council-members*') ? 'active' : '' }}"
            href="{{ route('admin.council-members.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <span data-feather="user-check" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">Kengash a'zolari</span>
                </span>
            </div>
        </a>
    </div>
</li>
@endcan

@php
    $settingsActive = request()->is('admin/users*', 'admin/roles*', 'admin/permissions*');
    $canViewSettings = auth()->user()?->can('Sozlamalar')
        || auth()->user()?->can('Foydalanuvchilar')
        || auth()->user()?->can('Rollar')
        || auth()->user()?->can('Ruxsatlar');
@endphp

@if ($canViewSettings)
<li class="nav-item">
    <div class="nav-item-wrapper">
        <a class="nav-link dropdown-indicator label-1 {{ $settingsActive ? '' : 'collapsed' }}"
            href="#nv-settings" role="button" data-bs-toggle="collapse"
            aria-expanded="{{ $settingsActive ? 'true' : 'false' }}" aria-controls="nv-settings">
            <div class="d-flex align-items-center">
                <span class="dropdown-indicator-icon-wrapper">
                    <span class="fas fa-caret-right dropdown-indicator-icon"></span>
                </span>
                <span class="nav-link-icon">
                    <span data-feather="settings" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">Sozlamalar</span>
                </span>
            </div>
        </a>
        <div class="parent-wrapper label-1">
            <ul class="nav collapse parent {{ $settingsActive ? 'show' : '' }}" data-bs-parent="#navbarVerticalNav"
                id="nv-settings">
                <li class="collapsed-nav-item-title d-none">Sozlamalar</li>

                @can('Foydalanuvchilar')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}"
                        href="{{ route('admin.users.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-text">Foydalanuvchilar</span>
                        </div>
                    </a>
                </li>
                @endcan

                @can('Rollar')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/roles*') ? 'active' : '' }}"
                        href="{{ route('admin.roles.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-text">Rollar</span>
                        </div>
                    </a>
                </li>
                @endcan

                @can('Ruxsatlar')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/permissions*') ? 'active' : '' }}"
                        href="{{ route('admin.permissions.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-text">Ruxsatlar</span>
                        </div>
                    </a>
                </li>
                @endcan
            </ul>
        </div>
    </div>
</li>
@endif
