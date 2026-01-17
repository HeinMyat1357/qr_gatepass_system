{{-- <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <div class="container">
        <a class="navbar-brand" href="/">
            <i class="fas fa-qrcode me-2"></i>QR Code Gate Pass System
        </a> --}}
        {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('moderator.home') }}">Home</a></li>
                </ul> --}}
            {{-- ✅ Show this part ONLY IF user is logged in --}}
            {{-- @auth
            <div class="dropdown">
                <button class="btn btn-outline-light dropdown-toggle" type="button" id="userMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user me-1"></i>
                    <span id="username-display">{{ Auth::user()->name }}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenuButton">
                    <li>
                        <a class="dropdown-item" href="{{ route('moderator.profile') }}">
                            <i class="fas fa-id-card me-1"></i> Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('moderator.qrcode') }}">
                            <i class="fas fa-qrcode me-1"></i> My QR Code
                        </a>
                    </li>
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
            @endauth --}}

            {{-- 🔓 Show Login/Register ONLY IF not logged in --}}
          
        {{-- </div>
    </div>
</nav> --}}
<nav class="navbar navbar-expand-lg navbar-dark neon-navbar sticky-top">
    <div class="container">
        <a class="nav-link neon-link" href="/">
            <i class="fas fa-qrcode me-2 neon-icon"></i>QR Code Gate Pass System
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link neon-link" href="/">Home</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link neon-link" href="/register">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link neon-link" href="/about">About</a>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>

<style>
/* Navbar styling */
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

/* Navbar toggler for mobile */
.navbar-dark .navbar-toggler-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30'
     xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%280, 255, 255, 1%29' stroke-width='2' 
     stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/ %3E%3C/svg%3E");
}
</style>
