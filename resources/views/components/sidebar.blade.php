<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets') }}/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets') }}/images/logo-dark.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets') }}/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets') }}/images/logo-light.png" alt="" height="17">
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
                <li class="menu-title">
                    <span data-key="t-menu">Menu</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link @if (Route::currentRouteName() == 'dashboard') active @endif"
                        href="{{ route('dashboard') }}">
                        <i class="ri-dashboard-2-line"></i>
                        <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                <!-- end Dashboard Menu -->
                <li class="menu-title">
                    <i class="ri-more-fill"></i>
                    <span data-key="t-pages">Data master</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAuth">
                        <i class="ri-account-circle-line"></i>
                        <span data-key="t-authentication">Operator</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('kriteria.index') }}">
                        <i class="ri-pages-line"></i>
                        <span data-key="t-pages">Kriteria Kepuasan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLanding" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarLanding">
                        <i class="ri-rocket-line"></i> <span data-key="t-landing">Landing</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLanding">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="landing.html" class="nav-link" data-key="t-one-page"> One Page </a>
                            </li>
                            <li class="nav-item">
                                <a href="nft-landing.html" class="nav-link" data-key="t-nft-landing"> NFT Landing
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="job-landing.html" class="nav-link" data-key="t-job">Job</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-components">Components</span>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarUI" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarUI">
                        <i class="ri-pencil-ruler-2-line"></i> <span data-key="t-base-ui">Base UI</span>
                    </a>
                    <div class="collapse menu-dropdown mega-dropdown-menu" id="sidebarUI">
                        <div class="row">
                            <div class="col-lg-4">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="ui-alerts.html" class="nav-link" data-key="t-alerts">Alerts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-badges.html" class="nav-link" data-key="t-badges">Badges</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-buttons.html" class="nav-link" data-key="t-buttons">Buttons</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-colors.html" class="nav-link" data-key="t-colors">Colors</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-cards.html" class="nav-link" data-key="t-cards">Cards</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-carousel.html" class="nav-link"
                                            data-key="t-carousel">Carousel</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-dropdowns.html" class="nav-link"
                                            data-key="t-dropdowns">Dropdowns</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-grid.html" class="nav-link" data-key="t-grid">Grid</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-4">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="ui-images.html" class="nav-link" data-key="t-images">Images</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-tabs.html" class="nav-link" data-key="t-tabs">Tabs</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-accordions.html" class="nav-link"
                                            data-key="t-accordion-collapse">Accordion & Collapse</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-modals.html" class="nav-link" data-key="t-modals">Modals</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-offcanvas.html" class="nav-link"
                                            data-key="t-offcanvas">Offcanvas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-placeholders.html" class="nav-link"
                                            data-key="t-placeholders">Placeholders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-progress.html" class="nav-link"
                                            data-key="t-progress">Progress</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-notifications.html" class="nav-link"
                                            data-key="t-notifications">Notifications</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-4">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="ui-media.html" class="nav-link" data-key="t-media-object">Media
                                            object</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-embed-video.html" class="nav-link" data-key="t-embed-video">Embed
                                            Video</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-typography.html" class="nav-link"
                                            data-key="t-typography">Typography</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-lists.html" class="nav-link" data-key="t-lists">Lists</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-links.html" class="nav-link"><span
                                                data-key="t-links">Links</span> <span
                                                class="badge badge-pill bg-success" data-key="t-new">New</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-general.html" class="nav-link" data-key="t-general">General</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-ribbons.html" class="nav-link" data-key="t-ribbons">Ribbons</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-utilities.html" class="nav-link"
                                            data-key="t-utilities">Utilities</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAdvanceUI" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarAdvanceUI">
                        <i class="ri-stack-line"></i> <span data-key="t-advance-ui">Advance UI</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAdvanceUI">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="advance-ui-sweetalerts.html" class="nav-link"
                                    data-key="t-sweet-alerts">Sweet
                                    Alerts</a>
                            </li>
                            <li class="nav-item">
                                <a href="advance-ui-nestable.html" class="nav-link"
                                    data-key="t-nestable-list">Nestable
                                    List</a>
                            </li>
                            <li class="nav-item">
                                <a href="advance-ui-scrollbar.html" class="nav-link"
                                    data-key="t-scrollbar">Scrollbar</a>
                            </li>
                            <li class="nav-item">
                                <a href="advance-ui-animation.html" class="nav-link"
                                    data-key="t-animation">Animation</a>
                            </li>
                            <li class="nav-item">
                                <a href="advance-ui-tour.html" class="nav-link" data-key="t-tour">Tour</a>
                            </li>
                            <li class="nav-item">
                                <a href="advance-ui-swiper.html" class="nav-link" data-key="t-swiper-slider">Swiper
                                    Slider</a>
                            </li>
                            <li class="nav-item">
                                <a href="advance-ui-ratings.html" class="nav-link" data-key="t-ratings">Ratings</a>
                            </li>
                            <li class="nav-item">
                                <a href="advance-ui-highlight.html" class="nav-link"
                                    data-key="t-highlight">Highlight</a>
                            </li>
                            <li class="nav-item">
                                <a href="advance-ui-scrollspy.html" class="nav-link"
                                    data-key="t-scrollSpy">ScrollSpy</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="widgets.html">
                        <i class="ri-honour-line"></i> <span data-key="t-widgets">Widgets</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarForms" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarForms">
                        <i class="ri-file-list-3-line"></i> <span data-key="t-forms">Forms</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarForms">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="forms-elements.html" class="nav-link" data-key="t-basic-elements">Basic
                                    Elements</a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-select.html" class="nav-link" data-key="t-form-select"> Form Select
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-checkboxs-radios.html" class="nav-link"
                                    data-key="t-checkboxs-radios">Checkboxs & Radios</a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-pickers.html" class="nav-link" data-key="t-pickers"> Pickers </a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-masks.html" class="nav-link" data-key="t-input-masks">Input
                                    Masks</a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-advanced.html" class="nav-link" data-key="t-advanced">Advanced</a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-range-sliders.html" class="nav-link" data-key="t-range-slider">
                                    Range
                                    Slider </a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-validation.html" class="nav-link"
                                    data-key="t-validation">Validation</a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-wizard.html" class="nav-link" data-key="t-wizard">Wizard</a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-editors.html" class="nav-link" data-key="t-editors">Editors</a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-file-uploads.html" class="nav-link" data-key="t-file-uploads">File
                                    Uploads</a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-layouts.html" class="nav-link" data-key="t-form-layouts">Form
                                    Layouts</a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-select2.html" class="nav-link" data-key="t-select2">Select2</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarTables" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarTables">
                        <i class="ri-layout-grid-line"></i> <span data-key="t-tables">Tables</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarTables">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="tables-basic.html" class="nav-link" data-key="t-basic-tables">Basic
                                    Tables</a>
                            </li>
                            <li class="nav-item">
                                <a href="tables-gridjs.html" class="nav-link" data-key="t-grid-js">Grid Js</a>
                            </li>
                            <li class="nav-item">
                                <a href="tables-listjs.html" class="nav-link" data-key="t-list-js">List Js</a>
                            </li>
                            <li class="nav-item">
                                <a href="tables-datatables.html" class="nav-link"
                                    data-key="t-datatables">Datatables</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCharts" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarCharts">
                        <i class="ri-pie-chart-line"></i> <span data-key="t-charts">Charts</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCharts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#sidebarApexcharts" class="nav-link" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarApexcharts"
                                    data-key="t-apexcharts">
                                    Apexcharts
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarApexcharts">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="charts-apex-line.html" class="nav-link" data-key="t-line">
                                                Line
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-area.html" class="nav-link" data-key="t-area">
                                                Area
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-column.html" class="nav-link" data-key="t-column">
                                                Column </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-bar.html" class="nav-link" data-key="t-bar"> Bar
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-mixed.html" class="nav-link" data-key="t-mixed">
                                                Mixed
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-timeline.html" class="nav-link"
                                                data-key="t-timeline">
                                                Timeline </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-range-area.html" class="nav-link"
                                                data-key="t-range-area">Range Area</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-funnel.html" class="nav-link"
                                                data-key="t-funnel">Funnel</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-candlestick.html" class="nav-link"
                                                data-key="t-candlstick"> Candlstick </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-boxplot.html" class="nav-link" data-key="t-boxplot">
                                                Boxplot </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-bubble.html" class="nav-link" data-key="t-bubble">
                                                Bubble </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-scatter.html" class="nav-link" data-key="t-scatter">
                                                Scatter </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-heatmap.html" class="nav-link" data-key="t-heatmap">
                                                Heatmap </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-treemap.html" class="nav-link" data-key="t-treemap">
                                                Treemap </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-pie.html" class="nav-link" data-key="t-pie"> Pie
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-radialbar.html" class="nav-link"
                                                data-key="t-radialbar"> Radialbar </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-radar.html" class="nav-link" data-key="t-radar">
                                                Radar
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-polar.html" class="nav-link"
                                                data-key="t-polar-area">
                                                Polar Area </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-slope.html" class="nav-link"><span
                                                    data-key="t-slope">Slope</span> <span
                                                    class="badge badge-pill bg-success"
                                                    data-key="t-new">New</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="charts-chartjs.html" class="nav-link" data-key="t-chartjs"> Chartjs </a>
                            </li>
                            <li class="nav-item">
                                <a href="charts-echarts.html" class="nav-link" data-key="t-echarts"> Echarts </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarIcons" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarIcons">
                        <i class="ri-compasses-2-line"></i> <span data-key="t-icons">Icons</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarIcons">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="icons-remix.html" class="nav-link"><span data-key="t-remix">Remix</span>
                                    <span class="badge badge-pill bg-info">v4.3</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="icons-boxicons.html" class="nav-link"><span
                                        data-key="t-boxicons">Boxicons</span> <span
                                        class="badge badge-pill bg-info">v2.1.4</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="icons-materialdesign.html" class="nav-link"><span
                                        data-key="t-material-design">Material Design</span> <span
                                        class="badge badge-pill bg-info">v7.2.96</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="icons-lineawesome.html" class="nav-link" data-key="t-line-awesome">Line
                                    Awesome</a>
                            </li>
                            <li class="nav-item">
                                <a href="icons-feather.html" class="nav-link"><span
                                        data-key="t-feather">Feather</span> <span
                                        class="badge badge-pill bg-info">v4.29.2</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="icons-crypto.html" class="nav-link"> <span data-key="t-crypto-svg">Crypto
                                        SVG</span></a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarMaps" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarMaps">
                        <i class="ri-map-pin-line"></i> <span data-key="t-maps">Maps</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarMaps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="maps-google.html" class="nav-link" data-key="t-google">
                                    Google
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="maps-vector.html" class="nav-link" data-key="t-vector">
                                    Vector
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="maps-leaflet.html" class="nav-link" data-key="t-leaflet">
                                    Leaflet
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarMultilevel" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarMultilevel">
                        <i class="ri-share-line"></i> <span data-key="t-multi-level">Multi Level</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarMultilevel">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-level-1.1"> Level 1.1 </a>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarAccount" class="nav-link" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="sidebarAccount" data-key="t-level-1.2">
                                    Level
                                    1.2
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarAccount">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" data-key="t-level-2.1"> Level 2.1
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#sidebarCrm" class="nav-link" data-bs-toggle="collapse"
                                                role="button" aria-expanded="false" aria-controls="sidebarCrm"
                                                data-key="t-level-2.2"> Level 2.2
                                            </a>
                                            <div class="collapse menu-dropdown" id="sidebarCrm">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link" data-key="t-level-3.1">
                                                            Level 3.1
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link" data-key="t-level-3.2">
                                                            Level 3.2
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
