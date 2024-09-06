<div class="vertical-menu">

    <div data-simplebar class="h-100">

        @php
            $userRole = auth()->user()->role;
        @endphp

        <div id="sidebar-menu">
            {{-- for admin --}}
            @if ($userRole === 'admin')
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title" key="t-menu">Admin</li>

                    <li>
                        <a href="{{ route('adminUser.index') }}" class="waves-effect">
                            <i class="far fa-user"></i>
                            <span>Manage Admins</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fa fa-users"></i>
                            <span key="t-dashboards">Users</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{ route('users.create') }}" class="waves-effect">
                                    <span>Add Users</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('users.index') }}" class="waves-effect">
                                    <span>Manage Users</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-title" key="t-components">Components</li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fa fa-users"></i>
                            <span key="t-dashboards">Users</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{ route('users.create') }}" class="waves-effect">
                                    <span>Add Users</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('users.index') }}" class="waves-effect">
                                    <span>Manage Users</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
            @elseif ($userRole == 'user')
                {{-- for user  --}}
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title" key="t-components">Component</li>
                    <li>
                        <a href="{{ route('csv-check.index') }}" class="waves-effect">
                            <i class="far fa-file"></i>
                            <span>Manual Check</span>
                        </a>
                    </li>
                </ul>
            @endif

            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-components">Sign Out</li>
                <li>
                    <a href="{{ route('logout') }}" class="waves-effect">
                        <i class="fa fa-power-off"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
