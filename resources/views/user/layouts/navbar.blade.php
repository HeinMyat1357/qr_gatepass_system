<nav class="navbar navbar-expand-lg neon-navbar sticky-top">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand neon-brand" href="{{ route('user.pages.home') }}">
            <i class="fas fa-qrcode me-2 neon-icon"></i>QR Code Gate Pass System
        </a>

        <!-- Toggler for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                                <li class="nav-item"><a class="nav-link {{ request()->routeIs('user.pages.home') ? 'active' : '' }} neon-link" href="{{ route('user.pages.home') }}"><i class="fas fa-id-card me-1 neon-icon-small"></i> Home</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('user.profile') ? 'active' : '' }} neon-link" href="{{ route('user.profile') }}"><i class="fas fa-id-card me-1 neon-icon-small"></i> Profile</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('user.qrcode') ? 'active' : '' }} neon-link" href="{{ route('user.qrcode') }}"><i class="fas fa-qrcode me-1 neon-icon-small"></i> My QR Code</a></li>
            </ul>

            <!-- Auth Dropdown -->
            @auth
            <div class="dropdown">
                <button class="btn neon-dropdown dropdown-toggle" type="button" id="userMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user me-1 neon-icon-small"></i>
                    <span>
                        @if(Auth::guard('web')->check())
                            {{ Auth::guard('web')->user()->name }}
                        @elseif(Auth::guard('visitor')->check())
                            {{ Auth::guard('visitor')->user()->visitor_name }}
                        @else
                            Guest
                        @endif
                    </span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end neon-dropdown-menu" aria-labelledby="userMenuButton">
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('moderator.logout') }}">
                            @csrf
                            <button class="dropdown-item neon-link" type="submit">
                                <i class="fas fa-sign-out-alt me-1"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            @endauth
        </div>
    </div>
</nav>

<style>
/* Navbar Gradient Background */
.neon-navbar {
    background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    padding: 0.6rem 1rem;
}

/* Brand Glow */
.neon-brand {
    color: #00ffff;
    font-weight: 600;
    text-shadow: 0 0 5px #00ffff, 0 0 10px #00bfff;
    transition: 0.3s;
}
.neon-brand:hover {
    text-shadow: 0 0 10px #00bfff, 0 0 20px #00ffff;
}

/* Icon Glow */
.neon-icon {
    color: #00ffff;
    text-shadow: 0 0 5px #00ffff, 0 0 10px #00bfff;
}
.neon-icon-small {
    color: #00ffff;
    text-shadow: 0 0 3px #00ffff, 0 0 6px #00bfff;
}

/* Links */
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

/* Dropdown Button */
.neon-dropdown {
    background: linear-gradient(135deg, #00ffff, #00bfff);
    color: #0f2027;
    font-weight: 500;
    border: none;
    border-radius: 50px;
    padding: 5px 15px;
    box-shadow: 0 4px #007bff;
    transition: all 0.2s ease;
}
.neon-dropdown:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px #007bff;
}

/* Dropdown Menu */
.neon-dropdown-menu {
    background: rgba(15, 32, 39, 0.95);
    border-radius: 12px;
    border: 1px solid #00ffff;
    box-shadow: 0 4px 15px rgba(0,255,255,0.3);
}
.neon-dropdown-menu .dropdown-item {
    color: #00ffff;
    transition: all 0.3s;
}
.neon-dropdown-menu .dropdown-item:hover {
    background: #00bfff;
    color: #fff;
}
</style>
