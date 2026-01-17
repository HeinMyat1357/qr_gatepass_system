<div class="forgot-password-container">
    <div class="forgot-password-card d-flex flex-column justify-content-between">
        <h2 class="text-center mb-4">Forgot Password</h2>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form action="{{ route('password.email') }}" method="POST" class="d-flex flex-column justify-content-between" style="height: 280px;">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control form-control-modern" placeholder="Enter your email" required>
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-modern w-100">Send Reset Link</button>

            <div class="text-center">
                <a href='/' class="forgot-link">Back to Login</a>
            </div>
        </form>
    </div>
</div>

<style>
/* Background */
.forgot-password-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: linear-gradient(120deg, #89f7fe 0%, #66a6ff 100%);
    padding: 20px;
}

/* Glassmorphism Card */
.forgot-password-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    padding: 40px 30px;
    max-width: 400px;
    width: 100%;
    box-shadow: 0 8px 32px rgba(0,0,0,0.25);
    border: 1px solid rgba(255,255,255,0.2);
}

/* Modern input */
.form-control-modern {
    border-radius: 50px;
    padding: 14px 20px;
    border: 1px solid rgba(255,255,255,0.3);
    background: rgba(255,255,255,0.2);
    color: #fff;
    font-weight: 500;
    transition: all 0.3s ease-in-out;
    margin-top: 8px;
}

.form-control-modern::placeholder {
    color: rgba(255,255,255,0.7);
}

.form-control-modern:focus {
    border-color: #ff6ec7;
    background: rgba(255,255,255,0.3);
    box-shadow: 0 0 10px rgba(255,110,199,0.5);
    outline: none;
}

/* Modern button */
.btn-modern {
    background: linear-gradient(135deg, #ff6ec7, #7873f5);
    color: #fff;
    font-weight: 600;
    border-radius: 50px;
    padding: 14px;
    border: none;
    transition: all 0.3s ease-in-out;
    margin-top: 15px;
}

.btn-modern:hover {
    background: linear-gradient(135deg, #ff85d0, #8a85ff);
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(138,133,255,0.4);
}

/* Forgot link */
.forgot-link {
    color: #ff6ec7;
    font-weight: 500;
    text-decoration: none;
    display: inline-block;
    margin-top: 15px;
    transition: all 0.3s;
}

.forgot-link:hover {
    color: #ff85d0;
    text-decoration: underline;
}
</style>
