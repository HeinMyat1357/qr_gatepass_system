<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QR Code Gate Pass System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        /* Hero Section */
        .hero {
            padding: 100px 0;
            background: linear-gradient(135deg, #1e3c72, #2a5298, #1e3c72);
            background-size: 400% 400%;
            animation: gradientBG 10s ease infinite;
            color: white;
            text-align: center;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
        }

        .hero p {
            font-size: 1.3rem;
            margin-top: 15px;
        }

        /* 3D Buttons */
        .btn-3d {
            text-decoration: none;
            display: inline-block;
            padding: 14px 30px;
            margin: 15px;
            font-size: 18px;
            font-weight: 600;
            color: #fff;
            background: #007bff;
            border: none;
            border-radius: 50px;
            box-shadow: 0 6px #0056b3;
            transition: all 0.2s ease;
            text-transform: uppercase;
        }

        .btn-3d:hover {
            background: #0056b3;
            box-shadow: 0 4px #003d80;
            transform: translateY(2px);
        }

        .btn-3d:active {
            transform: translateY(4px);
            box-shadow: 0 2px #003d80;
        }

        /* Info Section */
        .features {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: -50px;
            text-align: center;
        }

        .features h2 {
            font-weight: 700;
            margin-bottom: 20px;
        }

        .features p {
            font-size: 1.1rem;
            color: #555;
        }

        /* Footer */
        footer {
            background-color: #1e3c72;
            color: #f8f9fa;
            padding: 20px 0;
            text-align: center;
        }

    </style>
</head>
<body>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Welcome to QR Code Gate Pass System</h1>
            <p>Secure & Smart Entry System for Students, Teachers, and Visitors</p>
            
            <a href="{{ route('login') }}" class="btn-3d">Admin Login</a>
            <a href="{{ route('login.test') }}" class="btn-3d">Moderator Login</a>
            <a href="{{ route('login.test') }}" class="btn-3d">User Login</a>
        </div>
    </section>

    <!-- Info Section -->
   <div class="container mt-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-grid-fill me-2"></i> System Features
        </h2>
        <p class="text-muted">Discover the powerful features of our QR Code Gate Pass System</p>
    </div>

    <div class="row g-4">
        <!-- Feature 1 -->
        <div class="col-md-6 col-lg-3">
            <div class="card shadow-lg border-0 h-100 text-center p-3 hover-card">
                <div class="icon-circle bg-primary text-white mx-auto mb-3">
                    <i class="bi bi-qr-code" style="font-size: 2rem;"></i>
                </div>
                <h5 class="fw-bold">Secure QR Codes</h5>
                <p class="text-muted small">Generate unique, encrypted QR codes for each user.</p>
            </div>
        </div>

        <!-- Feature 2 -->
        <div class="col-md-6 col-lg-3">
            <div class="card shadow-lg border-0 h-100 text-center p-3 hover-card">
                <div class="icon-circle bg-success text-white mx-auto mb-3">
                    <i class="bi bi-clock-history" style="font-size: 2rem;"></i>
                </div>
                <h5 class="fw-bold">Real-time Tracking</h5>
                <p class="text-muted small">Monitor entry and exit in real-time with instant logs.</p>
            </div>
        </div>

        <!-- Feature 3 -->
        <div class="col-md-6 col-lg-3">
            <div class="card shadow-lg border-0 h-100 text-center p-3 hover-card">
                <div class="icon-circle bg-info text-white mx-auto mb-3">
                    <i class="bi bi-person-check" style="font-size: 2rem;"></i>
                </div>
                <h5 class="fw-bold">Admin Approval</h5>
                <p class="text-muted small">Approve users before granting permanent access.</p>
            </div>
        </div>

        <!-- Feature 4 -->
        <div class="col-md-6 col-lg-3">
            <div class="card shadow-lg border-0 h-100 text-center p-3 hover-card">
                <div class="icon-circle bg-warning text-white mx-auto mb-3">
                    <i class="bi bi-person-plus" style="font-size: 2rem;"></i>
                </div>
                <h5 class="fw-bold">Visitor QR Pass</h5>
                <p class="text-muted small">Provide temporary access with short-lived QR codes.</p>
            </div>
        </div>
    </div>
</div>

<style>
    .icon-circle {
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .hover-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }
</style>


    <!-- Footer -->
    {{-- <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} QR Code Gate Pass System. All rights reserved.</p>
        </div>
    </footer> --}}

</body>
</html>
