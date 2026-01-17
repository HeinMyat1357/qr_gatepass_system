<nav class="navbar navbar-expand-lg navbar-dark neon-navbar sticky-top">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand neon-link d-flex align-items-center" href="{{ route('moderator.home') }}">
            <i class="fas fa-qrcode me-2 neon-icon"></i>
            QR Code Gate Pass System
        </a>

        <!-- Toggler for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('moderator.home') ? 'active' : '' }} neon-link" 
                       href="{{ route('moderator.home') }}">
                       <i class="fas fa-home me-1"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('moderator.dashboard') ? 'active' : '' }} neon-link" 
                       href="{{ route('moderator.dashboard') }}">
                       <i class="fas fa-chart-line me-1"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('moderator.scan') ? 'active' : '' }} neon-link" 
                       href="{{ route('moderator.scan') }}">
                       <i class="fas fa-camera me-1"></i> Scan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('moderator.visitors') ? 'active' : '' }} neon-link" 
                       href="{{ route('moderator.visitors') }}">
                       <i class="fas fa-user-friends me-1"></i> Visitors
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('moderator.users') ? 'active' : '' }} neon-link" 
                       href="{{ route('moderator.users') }}">
                       <i class="fas fa-users me-1"></i> Users
                    </a>
                </li>
            </ul>

            <!-- User Dropdown -->
            <div class="dropdown">
                <button class="btn btn-info dropdown-toggle" type="button" id="userMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user me-1"></i>
                    <span id="username-display">@if(Auth::guard('web')->check()) {{ Auth::guard('web')->user()->name }} @elseif(Auth::guard('visitor')->check()) {{ Auth::guard('visitor')->user()->visitor_name }} @else Guest @endif</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenuButton">
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('moderator.logout') }}">
                            @csrf
                            <button class="dropdown-item" type="submit">
                                <i class="fas fa-sign-out-alt me-1"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<style>
/* Navbar container & gradient */
/* Navbar container & gradient */
.neon-navbar {
    background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
    border-bottom: 2px solid #00ffff;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    padding: 0.6rem 1rem;
}

/* Brand icon glow */
.neon-icon {
    color: #00ffff;
    text-shadow: 0 0 5px #00ffff, 0 0 10px #00bfff;
    transition: 0.3s;
}
.neon-icon:hover {
    color: #00bfff;
    text-shadow: 0 0 10px #00bfff, 0 0 20px #00ffff;
}

/* Navbar links */
.neon-link {
    color: #00ffff !important;
    font-weight: 500;
    transition: all 0.3s;
}
.neon-link:hover {
    color: #00bfff !important;
    text-shadow: 0 0 5px #00bfff, 0 0 10px #00ffff;
    text-decoration: none;
}

/* Navbar toggler */
/* .navbar-dark .navbar-toggler-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30'
     xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%280, 255, 255, 1%29' stroke-width='2' 
     stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/ %3E%3C/svg%3E");
} */

/* Dropdown menu */
.dropdown-menu {
    background-color: white;
    border: 1px solid #00ffff;
    box-shadow: 0 0 15px rgba(0, 255, 255, 0.5);
}

/* Dropdown items hover effect */
.dropdown-item:hover {
    background-color: #00bfff !important;
    color: #fff !important;
    text-shadow: 0 0 5px #00ffff;
}
.dropdown-item {
    background-color:white  !important;
    color: #00bfff !important;
    text-shadow: 0 0 5px #00ffff;
}
/* Dropdown arrow */
.dropdown-toggle::after {
    border-top: 0.3em solid #00ffff;
}

/* Ensure dropdown shows neon glow */
.dropdown-menu.show {
    animation: neonFadeIn 0.3s ease forwards;
}

@keyframes neonFadeIn {
    0% { opacity: 0; transform: translateY(-10px); }
    100% { opacity: 1; transform: translateY(0); }
}

</style>
