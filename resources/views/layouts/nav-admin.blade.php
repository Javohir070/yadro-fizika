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
                    <span data-feather="layout" style="height: 20px; width: 20px;"></span>
                </span>
                <span class="nav-link-text-wrapper">
                    <span class="nav-link-text">Bannerlar</span>
                </span>
            </div>
        </a>
    </div>
</li>

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