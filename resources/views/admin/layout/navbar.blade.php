<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link sidebar-toggle-btn" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>

        <li class="nav-item d-none d-sm-inline-block ms-3">
            <a href="/" class="nav-link home-btn">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->


    <!-- Logout end -->
</nav>


<style>
    /* Modern Home Button Style */
    .nav-link.home-btn {
        background: linear-gradient(135deg, #4facfe, #00f2fe);
        color: #fff !important;
        font-weight: 600;
        padding: 8px 18px;
        border-radius: 25px;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 4px 10px rgba(79, 172, 254, 0.4);
    }

    .nav-link.home-btn:hover {
        background: linear-gradient(135deg, #43e97b, #38f9d7);
        box-shadow: 0 6px 14px rgba(56, 249, 215, 0.5);
        transform: scale(1.05);
    }

    /* Style for Sidebar Toggle Button */
    .sidebar-toggle-btn {
        background: linear-gradient(135deg, #ff9a9e, #fad0c4);
        color: #fff !important;
        font-size: 18px;
        padding: 8px 10px;
        border-radius: 50%;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 4px 8px rgba(255, 154, 158, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .sidebar-toggle-btn:hover {
        background: linear-gradient(135deg, #a18cd1, #fbc2eb);
        /* transform: rotate(90deg) scale(1.1); */
        box-shadow: 0 6px 12px rgba(161, 140, 209, 0.5);
    }

    .navbar-nav .nav-item+.nav-item {
        margin-left: 10px;
        /* Adjust as needed */
    }
</style>

<!-- /.navbar -->
