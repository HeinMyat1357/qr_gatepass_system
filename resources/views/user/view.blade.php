<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile & QR Code</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">User Profile (ID: {{ $user->id }})</h4>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Phone:</strong> {{ $user->phone_number }}</p>

                <hr>
                <h5>My QR Code</h5>

                @if ($user->qr_code)
                    <img src="{{ asset('storage/qr_codes/' . $user->qr_code) }}"
                         alt="QR Code"
                         style="width: 200px; height: 200px;">
                @else
                    <p class="text-danger">QR Code not available.</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
