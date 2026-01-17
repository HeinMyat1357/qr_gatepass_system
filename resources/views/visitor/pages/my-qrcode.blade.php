@extends('visitor.layouts.layout')

@section('title', 'My QR Code')

@section('main-content')
@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::guard('visitor')->user();
@endphp

@if (!$user)
    <div class="alert alert-danger mt-5 text-center">
        You are not logged in. Please <a href="{{ route('login.test') }}">log in</a>.
    </div>
@else
<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow">
                <div class="card-header bg-gray text-info text-center">
                    <h4 class="mb-0"><i class="fas fa-qrcode me-2"></i>My QR Code</h4>
                </div>
                <div class="card-body p-4 text-center">

                    {{-- ✅ Profile --}}
                    <div class="user-avatar mb-3">
                        <img src="{{ $user->profile_image 
                            ? asset('uploads/profile_images/' . $user->profile_image)
                            : 'https://placehold.in/100' 
                        }}" 
                        class="rounded-circle" 
                        alt="Profile Image"
                        width="100" height="100">
                    </div>

                    <h3 class="mb-1">{{ $user->name }}</h3>
                    <p class="text-muted mb-3">
                        <span class="badge bg-info me-2">{{ ucfirst(optional($user->userType)->type_name ?? 'Visitor') }}</span>
                        <span>{{ $user->email }}</span>
                    </p>

                    {{-- ✅ QR Code --}}
                    @if ($user->qr_code_path)
                        <p class="mb-3">This QR code is linked to your account.</p>

                        {{-- Show QR dynamically (using QRCode.js) --}}
                        <div id="user-qrcode" class="my-3 d-flex justify-content-center"></div>

                        {{-- Show stored QR image --}}
                        <img id="qr-image" src="{{ asset('storage/' . $user->qr_code_path) }}" 
                             alt="My QR Code" width="250" height="250" class="mt-3" />

                        <p class="text-muted mt-4">
                            This is your personal Gate Pass QR code.
                        </p>

                        {{-- ✅ Action Buttons --}}
                        <div class="d-grid gap-2 col-md-6 mx-auto">
                            <a href="{{ route('visitor.download.qr', $user->id) }}" class="btn btn-primary">
                                <i class="fas fa-download me-1"></i> Download QR Code
                            </a>
                            <button id="print-qrcode" class="btn btn-outline-primary">
                                <i class="fas fa-print me-1"></i> Print QR
                            </button>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            QR Code not available. Please contact the administrator.
                        </div>
                    @endif
                </div>
            </div>

            {{-- Optional Attendance Table --}}
            <div class="card border-0 shadow mt-4">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Last Five Recent Gate Pass Records</h5>
        {{-- <span class="badge bg-primary">{{ $visitorLogs->count() }} Records</span> --}}
    </div>
    <div class="card-body">
        @if($visitorLogs->isEmpty())
            <p class="text-muted p-3">No visitor logs found.</p>
        @else
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Location</th>
                            <th>Scan Type</th>
                            <th>Scan Time</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($visitorLogs as $index => $log)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $log->location->name ?? 'N/A' }}</td>
                               <td>
                                  {{ $log->scan_type ?? 'N/A' }}
                                </td>
                                <td>{{ $log->scanned_at->format('d M Y, h:i A') }}</td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

    </div>
</div>

{{-- ✅ Hidden Print Area --}}
<div id="print-area" class="d-none">
    <div style="text-align:center; font-family:Arial;">
        <img src="{{ $user->profile_image 
            ? asset('uploads/profile_images/' . $user->profile_image)
            : 'https://placehold.in/100' 
        }}" width="120" height="120" style="border-radius:50%; margin-bottom:10px;">
        <h3>{{ $user->name }}</h3>
        <p>{{ $user->email }}</p>
        <img src="{{ asset('storage/' . $user->qr_code_path) }}" width="300" height="300" alt="QR Code">
        <p style="margin-top:10px;">Scan this QR code for your gate pass</p>
    </div>
</div>

@endif
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('print-qrcode').addEventListener('click', function () {
        const printContents = document.getElementById('print-area').innerHTML;
        const newWindow = window.open('', '', 'width=800,height=600');

        newWindow.document.write(`
            <html>
                <head>
                    <title>Print QR Code</title>
                    <style>
                        body { font-family: Arial, sans-serif; text-align: center; margin: 30px; }
                        img { max-width: 100%; }
                        h3 { margin: 10px 0; }
                        p { margin: 5px 0; }
                    </style>
                </head>
                <body>
                    ${printContents}
                </body>
            </html>
        `);

        newWindow.document.close();
        newWindow.focus();
        newWindow.print();
        newWindow.close();
    });
});
</script>
@endpush

@push('styles')
<style>
.user-avatar img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
}
 .gradient-text {
    background: linear-gradient(90deg, #00c6ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: bold;
}
/* .card-header{
     background: linear-gradient(90deg, #00c6ff, #0072ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: bold;
} */
body {
    background: linear-gradient(135deg, #f0f8ff, #d6eaff, #b3d8ff); /* Light blue gradient */
    min-height: 100vh;
    margin: 0;
    padding: 0;
}

.card-body {
    background-color: #c5e5f9; /* White for form card */
    border-radius: 1px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    padding: 20px;
}
</style>
@endpush
