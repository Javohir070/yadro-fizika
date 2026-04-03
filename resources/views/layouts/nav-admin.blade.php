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

<li class="nav-item">
    <div class="nav-item-wrapper">
        <a class="nav-link label-1 {{ request()->is('admin/banners*') ? 'active' : '' }}"
            href="{{ route('admin.banners.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                    <span data-feather="calendar" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">Bannerlar</span>
                </span>
            </div>
        </a>
    </div>
</li>