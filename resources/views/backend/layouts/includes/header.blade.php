<div id="layout-wrapper">
    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="{{ route('home') }}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('backend/assets/images/logo.svg') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="" height="17">
                        </span>
                    </a>

                    <a href="{{ route('home') }}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('backend/assets/images/logo.png') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt=""
                                height="59">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect"
                    id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
            </div>

            <div class="d-flex">

                <div class="dropdown d-inline-block">
                    <button type="button"
                        class="btn header-item waves-effect d-flex justify-content-between align-items-center w-xl"
                        id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="rounded-3 header-profile-user d-flex justify-content-center align-items-center">
                            <i class="fa fa-user-alt"></i>
                        </div>
                        <span class="d-none d-xl-inline-block ms-1 text-capitalize" key="t-henry">
                            {{ Auth::user()->name }}
                        </span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a class="dropdown-item" target="_blank" href="{{ route('home') }}"><i
                                class="bx bx-user font-size-16 align-middle me-1"></i> <span
                                key="t-profile">Website</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"><i
                                class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span
                                key="t-logout">Logout</span></a>
                    </div>
                </div>

            </div>
        </div>
    </header>
