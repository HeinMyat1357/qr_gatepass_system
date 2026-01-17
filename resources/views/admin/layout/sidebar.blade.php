<!-- Main Sidebar Container -->
<aside class="main-sidebar neon-sidebar elevation-4">
    <!-- Brand Logo -->
    <a class="brand-link neon-brand">
        <img src="{{ asset('dist/img/logo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3 neon-logo">
        <span class="brand-text">QR Gate Pass System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex neon-user">
            <div class="image">
                <img src="{{ asset('dist/img/profile.png') }}" class="img-circle elevation-2 neon-avatar"
                    alt="User Image">
            </div>
            <div class="info">
                <a class="d-block neon-text">Admin</a>

            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar neon-input" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar neon-btn">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column neon-menu" data-widget="treeview" role="menu"
                data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="/admin/dashboard" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- User Management -->
                {{-- <li class="nav-header">User Management</li> --}}
                <li class="nav-item {{ Request::is('add-user-type', 'view-user-types') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Request::is('add-user-type', 'view-user-types') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>User Type <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/add-user-type"
                                class="nav-link {{ Request::is('add-user-type') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add new user type</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/view-user-types"
                                class="nav-link {{ Request::is('view-user-types') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View all user types</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ Request::is('add-user', 'view-users') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('add-user', 'view-users') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-table"></i>
                        <p>User <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/add-user" class="nav-link {{ Request::is('add-user') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add new user</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/view-users" class="nav-link {{ Request::is('view-users') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View all users</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- App Management -->
                {{-- <li class="nav-header">App Management</li> --}}
                <li class="nav-item {{ Request::is('create-location', 'view-locations') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Request::is('create-location', 'view-locations') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>Locations <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/create-location"
                                class="nav-link {{ Request::is('create-location') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create new location</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/view-locations"
                                class="nav-link {{ Request::is('view-locations') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View all locations</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ Request::is('create-temp-pass', 'view-temp-passes') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Request::is('create-temp-pass', 'view-temp-passes') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Temporary Pass <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/view-temp-passes"
                                class="nav-link {{ Request::is('view-temp-passes') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View all Visitors</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Logs -->
                {{-- <li class="nav-header">Logs</li> --}}
                <li class="nav-item">
                    <a href="/gate-pass-logs" class="nav-link {{ Request::is('gate-pass-logs') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>Gate Pass Logs</p>
                    </a>
                </li>
            </ul>

            {{-- @guest
                <div class="sidebar-custom neon-footer">
                    <a href="/admin/login" class="btn btn-sm neon-btn">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                </div>
            @endguest --}}

            @auth
                <div class="sidebar-custom neon-footer mt-1"> <br>
                    <a href="login.from" class="btn btn-sm neon-btn" data-toggle="modal" data-target="#LogoutModal">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            @endauth
        </nav>
    </div>

    <!-- Sidebar Footer -->

</aside>

@include('admin.components.LogoutModal')
<style>
    /* Neon Text Effect */
    .neon-text {
        font-weight: bold;
        font-size: 16px;
        color: #0ff;
        /* Neon cyan */
        text-shadow:
            0 0 5px #0ff,
            0 0 10px #0ff,
            0 0 20px #0ff,
            0 0 40px #0ff;
        transition: 0.3s ease-in-out;
    }

    .neon-text:hover {
        color: #fff;
        text-shadow:
            0 0 10px #0ff,
            0 0 20px #0ff,
            0 0 40px #0ff,
            0 0 80px #0ff;
    }

    /* Neon Sidebar Base */
    .neon-sidebar {
        background: #0a0a0f;
        color: #0ff;
        box-shadow: inset 0 0 20px #0ff;
    }

    /* Brand */
    .neon-brand {
        background: #111;
        border-bottom: 1px solid #0ff;
        color: #0ff !important;
        text-shadow: 0 0 5px #0ff, 0 0 10px #0ff;
    }

    .neon-logo {
        box-shadow: 0 0 15px #0ff;
    }

    /* User Panel */
    .neon-user {
        border-bottom: 1px solid #0ff;
    }

    .neon-avatar {
        box-shadow: 0 0 10px #0ff;
    }

    /* Search */
    .neon-input {
        background: #111;
        border: 1px solid #0ff;
        color: #0ff;
        box-shadow: inset 0 0 10px #0ff;
    }

    .neon-btn {
        background: #0ff;
        color: #000;
        box-shadow: 0 0 15px #0ff;
        transition: 0.3s;
    }

    .neon-btn:hover {
        background: #fff;
        color: #000;
        box-shadow: 0 0 25px #0ff;
    }

    /* Menu */
    .neon-menu .nav-link {
        color: #0ff;
        transition: 0.3s;
    }

    .neon-menu .nav-link.active,
    .neon-menu .nav-link:hover {
        background: rgba(0, 255, 255, 0.2);
        color: #fff;
        box-shadow: 0 0 10px #0ff;
    }

    .neon-menu .nav-header {
        color: #ff00ff;
        text-shadow: 0 0 10px #ff00ff;
    }

    /* Footer */
    .neon-footer {
        border-top: 1px solid #0ff;
        background: #111;
    }
</style>
