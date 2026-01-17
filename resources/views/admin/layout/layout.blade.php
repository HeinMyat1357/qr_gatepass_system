<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QR Code Gate Pass System</title>

    <!-- Fonts & Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme & Plugins -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    @stack('styles')

    <style>
        /* === Neon Light Theme === */
        body {
            background: #0b0b0b;
            font-family: 'Segoe UI', sans-serif;
            color: #eaeaea;
        }

        /* Neon Background with Glowing Spots */
        .content-wrapper {
            background: linear-gradient(135deg, #0d0d0d, #1a1a1a, #000);
            position: relative;
            z-index: 1;
            min-height: 100vh;
        }

        .content-wrapper::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 20% 30%, rgba(0, 255, 200, 0.25), transparent 60%),
                radial-gradient(circle at 80% 70%, rgba(255, 0, 200, 0.25), transparent 60%),
                radial-gradient(circle at 50% 50%, rgba(0, 150, 255, 0.15), transparent 70%);
            z-index: -1;
        }

        /* Neon Headings */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        label {
            color: #0ff;
            text-shadow: 0 0 6px #0ff, 0 0 12px #00ffaa, 0 0 20px rgba(0, 255, 255, 0.6);
        }

        /* Neon Cards */
        .card {
            background: #111 !important;
            border-radius: 15px;
            border: 1px solid #222;
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.2),
                0 0 25px rgba(0, 200, 255, 0.2);
            transition: 0.3s;
        }

        .card:hover {
            box-shadow: 0 0 15px rgba(0, 255, 200, 0.5),
                0 0 40px rgba(0, 200, 255, 0.4),
                0 0 60px rgba(0, 150, 255, 0.3);
            transform: scale(1.02);
        }

        /* Neon Buttons */
        .btn-primary {
            background: #0ff !important;
            border: none;
            color: #000 !important;
            font-weight: bold;
            border-radius: 8px;
            padding: 10px 20px;
            box-shadow: 0 0 12px #0ff, 0 0 24px #00ffaa;
            transition: all 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background: #00ffaa !important;
            box-shadow: 0 0 20px #00ffaa, 0 0 40px #0ff;
            transform: translateY(-2px);
        }

        /* Neon Form Controls */
        .form-control {
            background: #000 !important;
            border: 1px solid #0ff;
            border-radius: 10px;
            color: #0ff;
        }

        .form-control:focus {
            border-color: #00ffaa;
            box-shadow: 0 0 12px #0ff, 0 0 25px #00ffaa;
        }

        /* Neon Sidebar */
        .main-sidebar {
            background: #111 !important;
            box-shadow: 0 0 10px #0ff inset;
        }

        .nav-sidebar .nav-link {
            color: #0ff !important;
            text-shadow: 0 0 6px #0ff;
        }

        .nav-sidebar .nav-link.active {
            background: rgba(0, 255, 255, 0.15);
            border-left: 3px solid #00ffaa;
            box-shadow: 0 0 10px #0ff;
        }

        /* Neon Navbar */
        .main-header {
            background: #111 !important;
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.3);
        }

        .main-header .nav-link {
            color: #0ff !important;
            text-shadow: 0 0 5px #0ff;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">
        @include('admin.layout.preloader')
        @include('admin.layout.navbar')
        @include('admin.layout.sidebar')
        @yield('main-content')
        @include('admin.layout.footer')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

    @stack('scripts')
</body>

</html>
