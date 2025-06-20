<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets') }}/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets') }}/images/logo-dark.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets') }}/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets') }}/images/logo/SipLayan.png" alt="" height="35">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div class="dropdown sidebar-user m-1 rounded">
        <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center gap-2">
                <img class="rounded header-profile-user" src="{{ asset('assets') }}/images/users/avatar-1.jpg"
                    alt="Header Avatar">
                <span class="text-start">
                    {{--  <span class="d-block fw-medium sidebar-user-name-text">{{ Auth::user()->name }}</span>  --}}
                    <span class="d-block fs-14 sidebar-user-name-sub-text">
                        <i class="ri ri-circle-fill fs-10 text-success align-baseline"></i>
                        <span class="align-middle">Online</span>
                    </span>
                </span>
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <!-- item-->
            {{--  <h6 class="dropdown-header">Welcome {{ Auth::user()->name }}!</h6>  --}}
            <a class="dropdown-item" href="pages-profile.html"><i
                    class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                    class="align-middle">Profile</span></a>
            <a class="dropdown-item" href="apps-chat.html"><i
                    class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i> <span
                    class="align-middle">Messages</span></a>
            <a class="dropdown-item" href="apps-tasks-kanban.html"><i
                    class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i> <span
                    class="align-middle">Taskboard</span></a>
            <a class="dropdown-item" href="pages-faqs.html"><i
                    class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span
                    class="align-middle">Help</span></a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="pages-profile.html"><i
                    class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Balance :
                    <b>$5971.67</b></span></a>
            <a class="dropdown-item" href="pages-profile-settings.html"><span
                    class="badge bg-success-subtle text-success mt-1 float-end">New</span><i
                    class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span
                    class="align-middle">Settings</span></a>
            <a class="dropdown-item" href="auth-lockscreen-basic.html"><i
                    class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Lock
                    screen</span></a>
            <a class="dropdown-item" href="auth-logout-basic.html"><i
                    class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle"
                    data-key="t-logout">Logout</span></a>
        </div>
    </div>
    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                {{--  <li class="menu-title">
                    <span data-key="t-menu">Menu</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link @if (Route::currentRouteName() == 'dashboard') active @endif"
                        href="{{ route('dashboard') }}">
                        <i class="ri-dashboard-2-line"></i>
                        <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li>  --}}
                <!-- end Dashboard Menu -->
                <li class="menu-title">
                    <i class="ri-more-fill"></i>
                    <span data-key="t-pages">Data master</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link @if (Route::currentRouteName() == 'user.index' || Route::currentRouteName() == 'pertanyaan.edit') active @endif"
                        href="{{ route('user.index') }}">
                        <i class="ri-pages-line"></i>
                        <span data-key="t-pages">Data Admin</span>
                    </a>
                </li>
                <li class="menu-title">
                    <i class="ri-more-fill"></i>
                    <span data-key="t-pages">Content</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link @if (Route::currentRouteName() == 'pertanyaan.index' || Route::currentRouteName() == 'pertanyaan.edit') active @endif"
                        href="{{ route('pertanyaan.index') }}">
                        <i class="ri-pages-line"></i>
                        <span data-key="t-pages">Pertanyaan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link @if (Route::currentRouteName() == 'pilihan.index' || Route::currentRouteName() == 'pertanyaan.edit') active @endif"
                        href="{{ route('pilihan.index') }}">
                        <i class="ri-pages-line"></i>
                        <span data-key="t-pages">Pilihan</span>
                    </a>
                </li>
                <li class="menu-title">
                    <i class="ri-more-fill"></i>
                    <span data-key="t-components">Content</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link @if (Route::currentRouteName() == 'alternatif.index') active @endif"
                        href="{{ route('alternatif.index') }}">
                        <i class="ri-pencil-ruler-2-line"></i>
                        <span data-key="t-base-ui">Pengunjung</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
