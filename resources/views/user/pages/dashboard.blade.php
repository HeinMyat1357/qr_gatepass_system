@extends('user.layouts.layout')

@section('title', 'Home - QR Code Gate Pass System')

@section('main-content')
<div class="container mt-5 mb-5">

    <!-- Hero Section -->
    <section id="section-home">
        <div class="row align-items-center mb-5">
            <div class="col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-lg neon-card">
                    <div class="card-body d-flex flex-column justify-content-center text-center text-md-start">
                        <h1 class="card-title neon-text">QR Code Gate Pass System</h1>
                        <h3 class="card-subtitle mb-3 text-muted">Fast, Secure, and Efficient</h3>
                        <p class="card-text mb-4">
                            Modern solution to track attendance for students, teachers, staff, and visitors with permanent and temporary QR codes.
                        </p>
                        <div class="mt-auto d-flex flex-column flex-md-row gap-2 justify-content-center justify-content-md-start">
                            <a href="{{ route('login.test') }}" class="btn btn-neon btn-lg">
                                <i class="fas fa-play-circle me-2"></i> Get Started
                            </a>
                            <a href="#features" class="btn btn-outline-light btn-lg neon-outline">
                                <i class="fas fa-info-circle me-2"></i> Learn More
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-lg neon-card">
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <img src="https://medicaldialogues.in/h-upload/2023/05/10/750x450_209269-qr-code.webp" 
                             alt="QR Code Attendance" class="img-fluid rounded neon-img">
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="row row-cols-1 row-cols-md-3 g-4 mb-5" id="features">
            <div class="col">
                <div class="card h-100 border-0 shadow-lg neon-card text-center p-3">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-qrcode fa-3x neon-text"></i>
                    </div>
                    <h5 class="card-title neon-text">Unique QR Codes</h5>
                    <p class="card-text">Permanent codes for users and temporary for visitors for seamless tracking.</p>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 border-0 shadow-lg neon-card text-center p-3">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-tachometer-alt fa-3x neon-text"></i>
                    </div>
                    <h5 class="card-title neon-text">Real-time Tracking</h5>
                    <p class="card-text">Monitor attendance instantly via our responsive dashboard.</p>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 border-0 shadow-lg neon-card text-center p-3">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-chart-bar fa-3x neon-text"></i>
                    </div>
                    <h5 class="card-title neon-text">Comprehensive Reports</h5>
                    <p class="card-text">Generate detailed reports for attendance and analysis.</p>
                </div>
            </div>
        </div>

        <!-- How It Works Section -->
        <div class="card border-0 shadow-lg neon-card mb-5 p-4">
            <h2 class="neon-text text-center mb-4">How It Works</h2>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="d-flex mb-4">
                        <div class="step-number bg-neon text-dark rounded-circle d-flex align-items-center justify-content-center me-3">1</div>
                        <div>
                            <h5 class="neon-text">Register or Check-in as Visitor</h5>
                            <p>Create an account or check in for temporary QR codes.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="step-number bg-neon text-dark rounded-circle d-flex align-items-center justify-content-center me-3">2</div>
                        <div>
                            <h5 class="neon-text">Present Your QR Code</h5>
                            <p>Scan at entry/exit points for automatic attendance recording.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex mb-4">
                        <div class="step-number bg-neon text-dark rounded-circle d-flex align-items-center justify-content-center me-3">3</div>
                        <div>
                            <h5 class="neon-text">Real-time Tracking</h5>
                            <p>Gate pass data is updated instantly on the dashboard.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="step-number bg-neon text-dark rounded-circle d-flex align-items-center justify-content-center me-3">4</div>
                        <div>
                            <h5 class="neon-text">Access Reports</h5>
                            <p>Generate detailed reports for analysis and record keeping.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
/* Neon Gradient Cards */
.neon-card {
    background: linear-gradient(145deg, #0ff, #f0f, #ff0);
    background-size: 400% 400%;
    animation: neon-gradient 8s ease infinite;
    border-radius: 15px;
    color: #fff;
}

@keyframes neon-gradient {
    0% {background-position: 0% 50%;}
    50% {background-position: 100% 50%;}
    100% {background-position: 0% 50%;}
}

/* Neon Text */
.neon-text {
    color: #0ff;
    text-shadow:
        0 0 5px #0ff,
        0 0 10px #0ff,
        0 0 20px #0ff,
        0 0 40px #f0f,
        0 0 80px #f0f;
}

/* Neon Buttons */
.btn-neon {
    background-color: #0ff;
    color: #000;
    font-weight: bold;
    text-transform: uppercase;
    box-shadow: 0 0 10px #0ff, 0 0 20px #0ff;
    transition: 0.3s;
}

.btn-neon:hover {
    box-shadow: 0 0 20px #0ff, 0 0 40px #f0f, 0 0 60px #ff0;
    color: #fff;
}

.btn-outline-light.neon-outline {
    border-color: #0ff;
    color: #0ff;
    box-shadow: 0 0 5px #0ff;
}

.btn-outline-light.neon-outline:hover {
    background-color: #0ff;
    color: #000;
    box-shadow: 0 0 20px #0ff, 0 0 40px #f0f;
}

/* Step numbers */
.step-number {
    width: 50px;
    height: 50px;
    font-weight: bold;
    font-size: 1.2rem;
    box-shadow: 0 0 10px #0ff, 0 0 20px #f0f;
}
</style>
@endsection
