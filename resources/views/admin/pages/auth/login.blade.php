<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | QR Code Gate Pass System</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Background Gradient */
        body {
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }

        /* Glassmorphism Card */
        .login-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            border-radius: 16px;
            padding: 2rem;
            width: 100%;
            max-width: 420px;
            text-align: center;
            color: #fff;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1s ease-in-out;
        }

        .login-card h2 {
            font-weight: 700;
            margin-bottom: 10px;
        }

        .login-card p {
            font-size: 14px;
            color: #e0e0e0;
            margin-bottom: 20px;
        }

        /* Input Group */
        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: none;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.3);
            color: #fff;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }

        .input-group-text {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: #fff;
        }

        /* 3D Button */
        .btn-3d {
            display: inline-block;
            width: 100%;
            padding: 14px;
            font-size: 18px;
            font-weight: bold;
            color: #fff;
            background: linear-gradient(145deg, #6a11cb, #2575fc);
            border: none;
            border-radius: 12px;
            box-shadow: 0 6px #1b4ca3;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-3d:hover {
            background: linear-gradient(145deg, #2575fc, #6a11cb);
            transform: translateY(2px);
            box-shadow: 0 4px #1b4ca3;
        }

        .btn-3d:active {
            transform: translateY(4px);
            box-shadow: 0 2px #1b4ca3;
        }

        /* Back Link */
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #fff;
            font-size: 16px;
            transition: 0.3s;
        }

        .back-btn:hover {
            color: #d1d1d1;
        }

        /* Animation */
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h2><i class="fas fa-user-shield"></i> Admin Login</h2>
        <p>Access your dashboard securely</p>

        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="mb-3 text-start">
                <label class="form-label text-light">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>
            </div>
            <div class="mb-3 text-start">
                <label class="form-label text-light">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>
            </div>

            <button type="submit" class="btn-3d mt-3">Login</button>
        </form>
                <a href="{{ route('password.request') }}" class="back-btn"><i class="fas"></i> Forgot Password</a><br>

        <a href="/" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Home</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
