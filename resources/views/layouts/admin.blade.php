<!DOCTYPE html>
<html lang="en">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="{{ config('app.name') }}">
    <meta name="description" content="{{ config('app.name') }}">
    <meta name="keywords" content="{{ config('app.name') }}">
    <meta name="author" content="{{ config('app.name') }}">
    <link  href="/admin/assets/img/logo." rel="stylesheet">
    <title>{{ config('app.name') }}</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/admin/vendors/simplebar/simplebar.min.js"></script>

    <link href="/admin/vendors/choices/choices.min.css" rel="stylesheet" />
    <script src="/admin/assets/js/config.js"></script>
    <link href="../../css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="vendors/simplebar/simplebar.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../release/v4.0.8/css/line.css">
    <link href="/admin/vendors/dropzone/dropzone.css" rel="stylesheet" />
    <link href="/admin/assets/css/theme-rtl.min.css" type="text/css" rel="stylesheet" id="style-rtl">
    <link href="/admin/assets/css/theme.min.css" type="text/css" rel="stylesheet" id="style-default">
    <link href="/admin/assets/css/user-rtl.min.css" type="text/css" rel="stylesheet" id="user-style-rtl">
    <link href="/admin/assets/css/user.min.css" type="text/css" rel="stylesheet" id="user-style-default">
    <link href="/admin/vendors/flatpickr/flatpickr.min.css" rel="stylesheet" />

    <script>
        var phoenixIsRTL = window.config.config.phoenixIsRTL;
        if (phoenixIsRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script>
    <link href="/admin/vendors/leaflet/leaflet.css" rel="stylesheet">
    <link href="/admin/vendors/leaflet.markercluster/MarkerCluster.css" rel="stylesheet">
    <link href="/admin/vendors/leaflet.markercluster/MarkerCluster.Default.css" rel="stylesheet">
    <link href="/admin/vendors/dropzone/dropzone.css" rel="stylesheet" />
    <link href="/admin/css.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>

</head>

<body @class(['hr-job-admin' => str_starts_with(request()->path(), 'admin/hr-job')])>

    <main class="main" id="top">

        <nav class="navbar navbar-vertical navbar-expand-lg" style="display:none;">
            <div class="collapse navbar-collapse" id="navbarVerticalCollapse">

                <div class="navbar-vertical-content pt-0">
                    <ul class="navbar-nav flex-column" id="navbarVerticalNav">

                        @include('layouts.nav-admin')

                    </ul>
                </div>
            </div>
            <div class="navbar-vertical-footer">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" style="padding: 8px; font-size:16px; gap:6px;"
                        class="btn border-0 fw-semibold w-100 d-flex align-items-center">
                        <span data-feather="log-out" style="height: 20px; width: 20px;"></span>
                        Tizimdan chiqish
                    </button>
                </form>

            </div>
        </nav>



        <nav class="navbar navbar-top fixed-top navbar-expand" id="navbarDefault" style="display:none;">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="navbar-logo">
                    <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
                        aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation">
                        <span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
                    <a class="navbar-brand me-1 me-sm-3" href="/">
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center">
                                    <img src="/admin/assets/img/logo.png" alt="Logo" width="40">
                                <h5 class="logo-text ms-2 d-none d-sm-block">{{ config('app.name') }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="search-box navbar-top-search-box d-none d-lg-block" data-list='{"valueNames":["title"]}'
                    style="width:25rem;">
                </div>
                <ul class="navbar-nav navbar-nav-icons flex-row">


                    <li class="nav-item">
                        <div class="theme-control-toggle fa-icon-wait px-2">
                            <input class="form-check-input ms-0 theme-control-toggle-input" type="checkbox"
                                data-theme-control="phoenixTheme" value="dark" id="themeControlToggle">
                            <label class="mb-0 theme-control-toggle-label theme-control-toggle-light"
                                for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                                data-bs-title="Switch theme" style="height:32px;width:32px;">
                                <span class="icon" data-feather="moon"></span>
                            </label>
                            <label class="mb-0 theme-control-toggle-label theme-control-toggle-dark"
                                for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                                data-bs-title="Switch theme" style="height:32px;width:32px;">
                                <span class="icon" data-feather="sun"></span>
                            </label>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" style="min-width: 2.25rem" role="button" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" data-bs-auto-close="outside">
                            <span class="d-block" style="height:26px;width:26px;position: relative;">
                                <span data-feather="bell" style="height:24px;width:24px;"></span>
                            </span>
                        </a>
                        {{-- <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border navbar-dropdown-caret"
                            id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">
                            <div class=" position-relative border-0">
                                <div class="card-header p-2">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="text-body-emphasis mb-0">{{ __('navbar.xabarnomalar') }}</h5>
                                        <form action="#" method="POST">
                                            @csrf
                                            <button class="btn btn-link p-0 fs-9 fw-normal"
                                                type="submit">{{ __('navbar.hammasini_o_qilgan_deb_belgilang') }}</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="scrollbar-overlay" style="height: 30rem;">
                                    </div>
                                </div>
                                <div class="card-footer p-0 border-top border-translucent border-0">
                                    <div class="my-2 text-center fw-bold fs-10 text-body-tertiary text-opactity-85">
                                        <a class="fw-bolder" href=""
                                            style="text-decoration: none;">{{ __('navbar.barcha_xabarlarni_ko_rish') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </li>
                    <li class="nav-item dropdown"><a class="nav-link lh-1 pe-0" id="navbarDropdownUser" href="#!"
                            role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true"
                            aria-expanded="false">
                            <div class="avatar avatar-l ">
                                <img class="rounded-circle " src="/admin/assets/img/team/avatar.webp" alt="">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border"
                            aria-labelledby="navbarDropdownUser">
                            <div class=" position-relative border-0">
                                <div class="card-body p-0">
                                    <div class="text-center pt-4 pb-3">
                                        <div class="avatar avatar-xl ">
                                            <img class="rounded-circle " src="/admin/assets/img/team/avatar.webp"
                                                alt="">
                                        </div>
                                        <h6 class="mt-2 text-body-emphasis">{{ auth()->user()->name }}</h6>
                                    </div>
                                </div>
                                <div class="overflow-auto scrollbar">
                                    <ul class="nav d-flex flex-column mb-0 pb-1">
                                        <li class="nav-item">
                                            <a class="nav-link px-3 py-2 d-flex align-items-center"
                                                href="">
                                                <span class="me-2 text-body" style="width: 18px; height: 18px;"
                                                    data-feather="user"></span>
                                                <span>Profile</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-footer p-0 border-top border-translucent ">
                                    <div class="px-3 mt-3">
                                        {{-- <a class="btn btn-phoenix-secondary d-flex flex-center w-100 " href="#!">
                                            <span class="me-2" data-feather="log-out"> </span>Chiqish
                                        </a> --}}
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link style="padding: 8px; font-size:16px;gap:6px;"
                                                class="btn btn-phoenix-secondary d-flex flex-center w-100 "
                                                :href="route('logout')" onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                <span data-feather="log-out" style="height: 20px; width: 20px;"></span>
                                                Tizimdan chiqish
                                            </x-dropdown-link>
                                        </form>
                                    </div>
                                    <div class="my-2 text-center fw-bold fs-10 text-body-quaternary"><a
                                            class="text-body-quaternary me-1"
                                            href="{{ route('home.index') }}">Bosh sahifa</a>&bull;
                                        <a class="text-body-quaternary mx-1" href="#!">Tizimdan chiqish</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>




        <script>
            var navbarTopShape = window.config.config.phoenixNavbarTopShape;
            var navbarPosition = window.config.config.phoenixNavbarPosition;
            var body = document.querySelector('body');
            var navbarDefault = document.querySelector('#navbarDefault');
            var navbarTop = document.querySelector('#navbarTop');
            var topNavSlim = document.querySelector('#topNavSlim');
            var navbarTopSlim = document.querySelector('#navbarTopSlim');
            var navbarCombo = document.querySelector('#navbarCombo');
            var navbarComboSlim = document.querySelector('#navbarComboSlim');
            var dualNav = document.querySelector('#dualNav');

            var documentElement = document.documentElement;
            var navbarVertical = document.querySelector('.navbar-vertical');

            if (navbarPosition === 'dual-nav') {
                topNavSlim?.remove();
                navbarTop?.remove();
                navbarTopSlim?.remove();
                navbarCombo?.remove();
                navbarComboSlim?.remove();
                navbarDefault?.remove();
                navbarVertical?.remove();
                dualNav.removeAttribute('style');
                document.documentElement.setAttribute('data-navigation-type', 'dual');

            } else if (navbarTopShape === 'slim' && navbarPosition === 'vertical') {
                navbarDefault?.remove();
                navbarTop?.remove();
                navbarTopSlim?.remove();
                navbarCombo?.remove();
                navbarComboSlim?.remove();
                topNavSlim.style.display = 'block';
                navbarVertical.style.display = 'inline-block';
                document.documentElement.setAttribute('data-navbar-horizontal-shape', 'slim');

            } else if (navbarTopShape === 'slim' && navbarPosition === 'horizontal') {
                navbarDefault?.remove();
                navbarVertical?.remove();
                navbarTop?.remove();
                topNavSlim?.remove();
                navbarCombo?.remove();
                navbarComboSlim?.remove();
                dualNav?.remove();
                navbarTopSlim.removeAttribute('style');
                document.documentElement.setAttribute('data-navbar-horizontal-shape', 'slim');
            } else if (navbarTopShape === 'slim' && navbarPosition === 'combo') {
                navbarDefault?.remove();
                navbarTop?.remove();
                topNavSlim?.remove();
                navbarCombo?.remove();
                navbarTopSlim?.remove();
                dualNav?.remove();
                navbarComboSlim.removeAttribute('style');
                navbarVertical.removeAttribute('style');
                document.documentElement.setAttribute('data-navbar-horizontal-shape', 'slim');
            } else if (navbarTopShape === 'default' && navbarPosition === 'horizontal') {
                navbarDefault?.remove();
                topNavSlim?.remove();
                navbarVertical?.remove();
                navbarTopSlim?.remove();
                navbarCombo?.remove();
                navbarComboSlim?.remove();
                dualNav?.remove();
                navbarTop.removeAttribute('style');
                document.documentElement.setAttribute('data-navigation-type', 'horizontal');
            } else if (navbarTopShape === 'default' && navbarPosition === 'combo') {
                topNavSlim?.remove();
                navbarTop?.remove();
                navbarTopSlim?.remove();
                navbarDefault?.remove();
                navbarComboSlim?.remove();
                dualNav?.remove();
                navbarCombo.removeAttribute('style');
                navbarVertical.removeAttribute('style');
                document.documentElement.setAttribute('data-navigation-type', 'combo');
            } else {
                topNavSlim?.remove();
                navbarTop?.remove();
                navbarTopSlim?.remove();
                navbarCombo?.remove();
                navbarComboSlim?.remove();
                dualNav?.remove();
                navbarDefault.removeAttribute('style');
                navbarVertical.removeAttribute('style');
            }

            var navbarTopStyle = window.config.config.phoenixNavbarTopStyle;
            var navbarTop = document.querySelector('.navbar-top');
            if (navbarTopStyle === 'darker') {
                navbarTop.setAttribute('data-navbar-appearance', 'darker');
            }

            var navbarVerticalStyle = window.config.config.phoenixNavbarVerticalStyle;
            var navbarVertical = document.querySelector('.navbar-vertical');
            if (navbarVerticalStyle === 'darker') {
                navbarVertical.setAttribute('data-navbar-appearance', 'darker');
            }
        </script>

        <div class="content">
            @yield('content')

            <footer class="footer position-absolute">
                <div class="row g-0 justify-content-between align-items-center h-100">
                    <div class="col-12 col-sm-auto text-center">
                        <p class="mb-0 mt-2 mt-sm-0 text-body">@ Barcha huquqlar himoyalangan<span
                                class="d-none d-sm-inline-block"></span><span
                                class="d-none d-sm-inline-block mx-1">|</span><br class="d-sm-none">2024 -
                            {{ date('Y') }}
                        </p>
                    </div>
                    <div class="col-12 col-sm-auto text-center">
                        <p class="mb-0 text-body-tertiary text-opacity-85">v1.20.2</p>
                    </div>
                </div>
            </footer>
        </div>

    </main>

    {{-- <div class="offcanvas offcanvas-end settings-panel border-0" id="settings-offcanvas" tabindex="-1"
        aria-labelledby="settings-offcanvas">
        <div class="offcanvas-header align-items-start border-bottom flex-column border-translucent">
            <div class="pt-1 w-100 mb-6 d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="mb-2 me-2 lh-sm"><span
                            class="fas fa-palette me-2 fs-8"></span>Mavzuni moslashtiruvchi</h5>
                    <p class="mb-0 fs-9">O'zingizning xohishingizga ko'ra turli xil uslublarni o'rgatiring</p>
                </div>
                <button class="btn p-1 fw-bolder" type="button" data-bs-dismiss="offcanvas" aria-label="Close"><span
                        class="fas fa-times fs-8"> </span>
                </button>
            </div>
            <button class="btn btn-phoenix-secondary w-100" data-theme-control="reset"><span
                    class="fas fa-arrows-rotate me-2 fs-10"></span>Standart holatga qaytarish</button>
        </div>
        <div class="offcanvas-body scrollbar px-card" id="themeController">
            <div class="setting-panel-item mt-0">
                <h5 class="setting-panel-item-title">Rang sxemasi</h5>
                <div class="row gx-2">
                    <div class="col-4"><input class="btn-check" id="themeSwitcherLight" name="theme-color" type="radio"
                            value="light" data-theme-control="phoenixTheme"><label
                            class="btn d-inline-block btn-navbar-style fs-9" for="themeSwitcherLight"> <span
                                class="mb-2 rounded d-block"><img class="img-fluid img-prototype mb-0"
                                    src="/admin/assets/img/generic/default-light.png" alt=""></span><span
                                class="label-text">Light</span></label></div>
                    <div class="col-4"><input class="btn-check" id="themeSwitcherDark" name="theme-color" type="radio"
                            value="dark" data-theme-control="phoenixTheme"><label
                            class="btn d-inline-block btn-navbar-style fs-9" for="themeSwitcherDark"> <span
                                class="mb-2 rounded d-block"><img class="img-fluid img-prototype mb-0"
                                    src="/admin/assets/img/generic/default-dark.png" alt=""></span><span
                                class="label-text">Dark</span></label></div>
                    <div class="col-4"><input class="btn-check" id="themeSwitcherAuto" name="theme-color" type="radio"
                            value="auto" data-theme-control="phoenixTheme"><label
                            class="btn d-inline-block btn-navbar-style fs-9" for="themeSwitcherAuto"> <span
                                class="mb-2 rounded d-block"><img class="img-fluid img-prototype mb-0"
                                    src="/admin/assets/img/generic/auto.png" alt=""></span><span class="label-text">
                                {{ __('navbar.auto') }}</span></label></div>
                </div>
            </div>

            <div class="setting-panel-item">
                <h5 class="setting-panel-item-title">Vertikal navbar ko'rinishi</h5>
                <div class="row gx-2">
                    <div class="col-6"><input class="btn-check" id="navbar-style-default" type="radio"
                            name="config.name" value="default" data-theme-control="phoenixNavbarVerticalStyle"><label
                            class="btn d-block w-100 btn-navbar-style fs-9" for="navbar-style-default"> <img
                                class="img-fluid img-prototype d-dark-none"
                                src="/admin/assets/img/generic/default-light.png" alt=""><img
                                class="img-fluid img-prototype d-light-none"
                                src="/admin/assets/img/generic/default-dark.png" alt=""><span
                                class="label-text d-dark-none">Default</span><span
                                class="label-text d-light-none">Default</span></label></div>
                    <div class="col-6"><input class="btn-check" id="navbar-style-dark" type="radio" name="config.name"
                            value="darker" data-theme-control="phoenixNavbarVerticalStyle"><label
                            class="btn d-block w-100 btn-navbar-style fs-9" for="navbar-style-dark"> <img
                                class="img-fluid img-prototype d-dark-none"
                                src="/admin/assets/img/generic/vertical-darker.png" alt=""><img
                                class="img-fluid img-prototype d-light-none"
                                src="/admin/assets/img/generic/vertical-lighter.png" alt=""><span
                                class="label-text d-dark-none">Darker</span><span
                                class="label-text d-light-none">Lighter</span></label></div>
                </div>
            </div>

            <div class="setting-panel-item">
                <h5 class="setting-panel-item-title">Gorizontal navbar ko'rinishi</h5>
                <div class="row gx-2">
                    <div class="col-6">
                        <input class="btn-check" id="navbarTopDefault" name="navbar-top-style" type="radio"
                            value="default" data-theme-control="phoenixNavbarTopStyle">
                        <label class="btn d-inline-block btn-navbar-style fs-9" for="navbarTopDefault"> <span
                                class="mb-2 rounded d-block">
                                <img class="img-fluid img-prototype d-dark-none mb-0"
                                    src="/admin/assets/img/generic/top-default.png" alt="">
                                <img class="img-fluid img-prototype d-light-none mb-0"
                                    src="/admin/assets/img/generic/top-style-darker.png" alt=""></span>
                            <span class="label-text">Default</span></label>
                    </div>
                    <div class="col-6">
                        <input class="btn-check" id="navbarTopDarker" name="navbar-top-style" type="radio"
                            value="darker" data-theme-control="phoenixNavbarTopStyle">
                        <label class="btn d-inline-block btn-navbar-style fs-9" for="navbarTopDarker"> <span
                                class="mb-2 rounded d-block">
                                <img class="img-fluid img-prototype d-dark-none mb-0"
                                    src="/admin/assets/img/generic/navbar-top-style-light.png" alt="">
                                <img class="img-fluid img-prototype d-light-none mb-0"
                                    src="/admin/assets/img/generic/top-style-lighter.png" alt=""></span>
                            <span class="label-text d-dark-none">Darker</span><span
                                class="label-text d-light-none">Lighter</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a class=" setting-toggle" href="#settings-offcanvas" data-bs-toggle="offcanvas"
        style="background-color: #FFFFFF;    border: 1px solid rgb(203 208 221 / 54%);border-radius: 6px;">
        <div class="card-body d-flex align-items-center px-2 py-1">
            <div class="position-relative rounded-start" style="height:34px;width:28px">
                <div class="settings-popover">
                    <span class="ripple">
                        <span class="fa-spin position-absolute all-0 d-flex flex-center">
                            <span class="icon-spin position-absolute all-0 d-flex flex-center">
                                <svg width="20" height="20" viewbox="0 0 20 20" fill="#ffffff"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M19.7369 12.3941L19.1989 12.1065C18.4459 11.7041 18.0843 10.8487 18.0843 9.99495C18.0843 9.14118 18.4459 8.28582 19.1989 7.88336L19.7369 7.59581C19.9474 7.47484 20.0316 7.23291 19.9474 7.03131C19.4842 5.57973 18.6843 4.28943 17.6738 3.20075C17.5053 3.03946 17.2527 2.99914 17.0422 3.12011L16.393 3.46714C15.6883 3.84379 14.8377 3.74529 14.1476 3.3427C14.0988 3.31422 14.0496 3.28621 14.0002 3.25868C13.2568 2.84453 12.7055 2.10629 12.7055 1.25525V0.70081C12.7055 0.499202 12.5371 0.297594 12.2845 0.257272C10.7266 -0.105622 9.16879 -0.0653007 7.69516 0.257272C7.44254 0.297594 7.31623 0.499202 7.31623 0.70081V1.23474C7.31623 2.09575 6.74999 2.8362 5.99824 3.25599C5.95774 3.27861 5.91747 3.30159 5.87744 3.32493C5.15643 3.74527 4.26453 3.85902 3.53534 3.45302L2.93743 3.12011C2.72691 2.99914 2.47429 3.03946 2.30587 3.20075C1.29538 4.28943 0.495411 5.57973 0.0322686 7.03131C-0.051939 7.23291 0.0322686 7.47484 0.242788 7.59581L0.784376 7.8853C1.54166 8.29007 1.92694 9.13627 1.92694 9.99495C1.92694 10.8536 1.54166 11.6998 0.784375 12.1046L0.242788 12.3941C0.0322686 12.515 -0.051939 12.757 0.0322686 12.9586C0.495411 14.4102 1.29538 15.7005 2.30587 16.7891C2.47429 16.9504 2.72691 16.9907 2.93743 16.8698L3.58669 16.5227C4.29133 16.1461 5.14131 16.2457 5.8331 16.6455C5.88713 16.6767 5.94159 16.7074 5.99648 16.7375C6.75162 17.1511 7.31623 17.8941 7.31623 18.7552V19.2891C7.31623 19.4425 7.41373 19.5959 7.55309 19.696C7.64066 19.7589 7.74815 19.7843 7.85406 19.8046C9.35884 20.0925 10.8609 20.0456 12.2845 19.7729C12.5371 19.6923 12.7055 19.4907 12.7055 19.2891V18.7346C12.7055 17.8836 13.2568 17.1454 14.0002 16.7312C14.0496 16.7037 14.0988 16.6757 14.1476 16.6472C14.8377 16.2446 15.6883 16.1461 16.393 16.5227L17.0422 16.8698C17.2527 16.9907 17.5053 16.9504 17.6738 16.7891C18.7264 15.7005 19.4842 14.4102 19.9895 12.9586C20.0316 12.757 19.9474 12.515 19.7369 12.3941ZM10.0109 13.2005C8.1162 13.2005 6.64257 11.7893 6.64257 9.97478C6.64257 8.20063 8.1162 6.74905 10.0109 6.74905C11.8634 6.74905 13.3792 8.20063 13.3792 9.97478C13.3792 11.7893 11.8634 13.2005 10.0109 13.2005Z"
                                        fill="#2A7BE4"></path>
                                </svg>
                            </span>
                        </span>
                    </span>
                </div>
            </div>
            <small
                class="text-uppercase text-body-tertiary fw-bold py-2 pe-2 ps-1 rounded-end">Moslashtirish</small>
        </div>
    </a> --}}
    <!-- ===============================================-->
    <script src="/admin/vendors/dropzone/dropzone-min.js"></script>
    <script src="/admin/vendors/popper/popper.min.js"></script>
    <script src="/admin/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="/admin/vendors/anchorjs/anchor.min.js"></script>
    <script src="/admin/vendors/is/is.min.js"></script>
    <script src="/admin/vendors/fontawesome/all.min.js"></script>
    <script src="/admin/vendors/lodash/lodash.min.js"></script>
    <script src="/admin/vendors/list.js/list.min.js"></script>
    <script src="/admin/vendors/feather-icons/feather.min.js"></script>
    <script src="/admin/vendors/dayjs/dayjs.min.js"></script>
    <script src="/admin/vendors/fullcalendar/index.global.min.js"></script>
    <script src="/admin/vendors/flatpickr/flatpickr.min.js"></script>
    <script src="/admin/vendors/leaflet/leaflet.js"></script>
    <script src="/admin/vendors/leaflet.markercluster/leaflet.markercluster.js"></script>
    <script src="/admin/vendors/leaflet.tilelayer.colorfilter/leaflet-tilelayer-colorfilter.min.js"></script>
    <script src="/admin/assets/js/phoenix.js"></script>
    <script src="/admin/vendors/echarts/echarts.min.js"></script>
    <script src="/admin/assets/js/ecommerce-dashboard.js"></script>
    <script src="/admin/assets/js/model.js"></script>
    <script src="/admin/assets/js/calendar.js"></script>
    <script src="/admin/assets/js/room-calendar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="/admin/assets/js/crm-dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/uz.js"></script>
    <script src="/admin/vendors/choices/choices.min.js"></script>
    <script src="/admin/vendors/choices/choices.min.js"></script>
    <script src="/admin/vendors/tinymce/tinymce.min.js"></script>
    <script src="/admin/vendors/dropzone/dropzone-min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var toastEl = document.querySelector('.toast');
            if (toastEl) {
                var toast = new bootstrap.Toast(toastEl, {
                    delay: 10000
                });
                toast.show();
            }
        });
    </script>
</body>

</html>