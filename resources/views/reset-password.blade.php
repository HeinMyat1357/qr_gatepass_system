<div class="reset-password-container">
    <div class="reset-password-card d-flex flex-column justify-content-between">
        <h2 class="text-center mb-4">Reset Password</h2>

        <form action="{{ route('password.update') }}" method="POST" class="flex-grow-1 d-flex flex-column justify-content-around">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control form-control-modern" placeholder="Enter your email" required>
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="password" class="form-control form-control-modern" placeholder="Enter new password" required>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control form-control-modern" placeholder="Confirm new password" required>
            </div>

            <button type="submit" class="btn btn-modern w-100">Reset Password</button>
        </form>

        <div class="text-center mt-3">
            <a href='/' class="forgot-link">Back to Login</a>
        </div>
    </div>
</div>

<style>
/* Background */
.reset-password-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: linear-gradient(120deg, #89f7fe 0%, #66a6ff 100%);
    padding: 20px;
}

/* Glassmorphism Card */
.reset-password-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    padding: 40px 30px;
    max-width: 400px;
    width: 100%;
    display: flex;
    flex-direction: column;
    height: 450px; /* Fix height for equal spacing */
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
    margin-bottom: 15px;
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
    transition: all 0.3s;
}

.forgot-link:hover {
    color: #ff85d0;
    text-decoration: underline;
}
</style>
