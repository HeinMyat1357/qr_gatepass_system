<nav class="navbar navbar-expand-lg navbar-dark neon-navbar sticky-top">
    <div class="container">
        <a class="navbar-brand neon-text" href="{{ route('visitor.pages.home') }}">
            <i class="fas fa-qrcode me-2"></i>QR Code Gate Pass System
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                                <li class="nav-item"><a class="nav-link {{ request()->routeIs('visitor.pages.home') ? 'active' : '' }} neon-link" href="{{ route('visitor.pages.home') }}"><i class="fas fa-id-card me-1"></i> Home</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('visitor.profile') ? 'active' : '' }} neon-link" href="{{ route('visitor.profile') }}"><i class="fas fa-id-card me-1"></i> Profile</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('visitor.qrcode') ? 'active' : '' }} neon-link" href="{{ route('visitor.qrcode') }}"><i class="fas fa-qrcode me-1"></i> My QRcode</a></li>
            </ul>

            <div class="dropdown">
                <button class="btn btn-outline-light neon-btn dropdown-toggle" type="button" id="userMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user me-1"></i>
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
                <ul class="dropdown-menu dropdown-menu-end neon-dropdown" aria-labelledby="userMenuButton">
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('moderator.logout') }}">
                            @csrf
                            <button class="dropdown-item neon-dropdown-item" type="submit">
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
/* Neon Navbar */
.neon-navbar {
    background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    padding: 0.6rem 1rem;
}

.neon-text {
    color: #0ff;
    text-shadow: 0 0 5px #0ff, 0 0 10px #0ff, 0 0 20px #f0f, 0 0 40px #f0f, 0 0 60px #ff0;
    font-weight: bold;
    font-size: 1.1rem;
}

.neon-link {
    color: #0ff !important;
    text-shadow: 0 0 5px #0ff, 0 0 10px #0ff;
    transition: 0.3s;
}

.neon-link:hover {
    color: #00bfff !important;
    text-shadow: 0 0 5px #00bfff, 0 0 10px #00ffff;
    text-decoration: none;
}

.neon-btn {
    color: #0ff;
    border: 1px solid #0ff;
    text-shadow: 0 0 5px #0ff;
    box-shadow: 0 0 5px #0ff, 0 0 10px #f0f;
    transition: 0.3s;
}

.neon-btn:hover {
    background-color: #0ff;
    color: #000;
    box-shadow: 0 0 15px #0ff, 0 0 30px #f0f, 0 0 50px #ff0;
}

.neon-dropdown {
    background-color: #111;
    box-shadow: 0 0 10px #0ff, 0 0 20px #f0f;
}

.neon-dropdown-item {
    color: #0ff;
    text-shadow: 0 0 3px #0ff;
}

.neon-dropdown-item:hover {
    color: #fff;
    background-color: #0ff;
    text-shadow: 0 0 10px #0ff, 0 0 20px #f0f;
}
</style>
