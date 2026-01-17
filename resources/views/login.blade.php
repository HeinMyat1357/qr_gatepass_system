@extends('moderator.layouts.layout1')

@section('title', 'Login-QR Code Gate Pass System')

@section('main-content')
<div class="login-container">
    <div class="login-card">
        <div class="login-header text-center">
            <h3><i class="fas fa-user-shield me-2"></i> Login</h3>
        </div>

        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger text-center">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login.save') }}">
            @csrf
          <div class="form-group mb-3">
    <label for="login" class="form-label">Email or User Name</label>
    <div class="input-group">
        <span class="input-group-text"><i class="fas fa-user"></i></span>
        <input type="text" class="form-control neon-input" name="login" id="login" placeholder="Enter email or user name" required>
    </div>
</div>


            <div class="form-group mb-3">
                <label for="login-password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" id="login-password" class="form-control neon-input" placeholder="Enter your password" required>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                {{-- <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember-me" name="remember">
                    <label class="form-check-label" for="remember-me">Remember me</label>
                </div> --}}
                <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
            </div><br>

            <div class="d-grid">
                <button type="submit" class="btn btn-3d-neon">Login</button>
            </div>
        </form>

        <div class="text-center mt-3 text-white">
            <p>Don't have an account? <a href="{{ route('register.test') }}" class="fw-semibold text-decoration-none neon-link">Create a new account</a></p>
        </div>
    </div>
</div>

<style>
/* Container & Background */
.login-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
    position: relative;
    overflow: hidden;
}

/* Floating card */
.login-card {
    background: #1c2020;
    padding: 2.5rem;
    border-radius: 20px;
    width: 100%;
    max-width: 480px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.5);
    border: 1px solid rgba(255,255,255,0.1);
}

/* Header */
.login-header h3 {
    color: #fff;
    font-weight: 700;
    margin-bottom: 1rem;
}

/* Neon Inputs */
.neon-input {
    border-radius: 12px;
    border: 1px solid #444;
    background: #1c1c1c;
    color: #fff;
    padding: 12px;
    box-shadow: 0 0 5px #007bff inset;
    transition: 0.3s;
}

.neon-input:focus {
    outline: none;
    box-shadow: 0 0 8px #00ffff;
    border-color: #00ffff;
}

/* Input icons */
.input-group-text {
    background: #111;
    border: none;
    color: #00ffff;
}

/* 3D Neon Button */
.btn-3d-neon {
    background: linear-gradient(135deg, #00ffff, #007bff);
    color: #fff;
    font-weight: 600;
    border-radius: 50px;
    padding: 12px;
    font-size: 1.1rem;
    border: none;
    box-shadow: 0 6px #00bfff;
    text-transform: uppercase;
    transition: all 0.3s ease;
}

.btn-3d-neon:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px #00bfff;
    background: linear-gradient(135deg, #00bfff, #00ffff);
}

.btn-3d-neon:active {
    transform: translateY(2px);
    box-shadow: 0 4px #007bff;
}

/* Links */
.neon-link, .forgot-link {
    color: #00ffff;
    transition: 0.3s;
}

.neon-link:hover, .forgot-link:hover {
    color: #00bfff;
    text-decoration: underline;
}

/* Form labels */
label {
    color: #fff;
    font-weight: 500;
}
</style>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endpush
