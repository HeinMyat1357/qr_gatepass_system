@extends('moderator.layouts.layout')

@section('title', 'My QR Code')

@section('main-content')
@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
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
                <div class="card-header bg-white text-center">
                    <h4 class="mb-0"><i class="fas fa-qrcode me-2"></i>My QR Code</h4>
                </div>
                <div class="card-body p-4 text-center">
                    <div class="user-avatar mb-3">
                        <img src="{{ $user->profile_image 
                            ? asset('uploads/profile_images/' . $user->profile_image)
                            : 'https://placehold.in/100' 
                        }}" class="rounded-circle" width="100" alt="Profile Image">
                    </div>
                    <h3 class="mb-1">{{ $user->name }}</h3>
                    <p class="text-muted mb-3">
                        <span class="badge bg-info me-2">{{ ucfirst($user->user_type ?? 'User') }}</span>
                        <span>{{ $user->email }}</span>
                    </p>
                                <div class="qrcode-container my-4 text-center">
                                    {!! $qrCode !!}
                                </div>

                    <p class="text-muted mb-4">
                        This is your personal attendance QR code. Show this code to scan your attendance at designated locations.
                    </p>
                    <div class="d-grid gap-2 col-md-6 mx-auto">
                            <button id="download-qrcode" class="btn btn-primary">
                                <i class="fas fa-download me-1"></i> Download QR Code
                            </button>
                        
                        <button id="print-qrcode" class="btn btn-outline-primary">
                            <i class="fas fa-print me-1"></i> Print QR Code
                        </button>
                    </div>
                </div>
            </div>

            {{-- Optional Attendance Table --}}
            <div class="card border-0 shadow mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Recent Attendance Records</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Attendance data will be shown here after system integration.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection


@push('scripts')
    <!-- ✅ Load QRCode library -->
    <script src="{{ asset('moderator/js/qrcode.min.js') }}"></script>
    <script src="{{ asset('moderator/js/my-qrcode.js') }}"></script>

    <!-- ✅ Render QR Code -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const qrValue = @json($user->qr_token); // safer Blade output

            if (qrValue && typeof QRCode !== 'undefined') {
                new QRCode(document.getElementById("user-qrcode"), {
                    text: qrValue,
                    width: 200,
                    height: 200,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
            } else {
                console.error("QRCode not loaded or value empty:", qrValue);
            }
        });
    </script>
   <!-- ✅ Load after page content is loaded -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const svgElement = document.querySelector('.qrcode-container svg');
        if (!svgElement) {
            alert('QR Code not found!');
            return;
        }

        const downloadBtn = document.getElementById('download-qrcode');
        downloadBtn.addEventListener('click', function () {
            const svgData = new XMLSerializer().serializeToString(svgElement);
            const canvas = document.createElement('canvas');
            const svgSize = svgElement.getBoundingClientRect();

            // ✅ High-resolution canvas
            canvas.width = svgSize.width * 3;
            canvas.height = svgSize.height * 3;

            const ctx = canvas.getContext('2d');
            const img = new Image();
            const svgBlob = new Blob([svgData], { type: 'image/svg+xml;charset=utf-8' });
            const url = URL.createObjectURL(svgBlob);

            img.onload = function () {
                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                URL.revokeObjectURL(url);

                const pngUrl = canvas.toDataURL('image/png');
                const link = document.createElement('a');
                link.href = pngUrl;
                link.download = 'my-qrcode.png';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            };

            img.src = url;
        });
    });
</script>


@endpush

        {{-- // Wait until the DOM is ready
        // document.addEventListener("DOMContentLoaded", function () {
        //     new QRCode(document.getElementById("user-qrcode"), {
        //         text: qrValue,
        //         width: 200,
        //         height: 200,
        //         colorDark: "#000000",
        //         colorLight: "#ffffff",
        //         correctLevel: QRCode.CorrectLevel.H
        //     });
        // });
    // </script> --}}
{{-- <script src="{{ asset('moderator/js/qrcode.min.js') }}"></script> --}}

{{-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        const qrValue = `{!! $user->qr_token !!}`; // inject raw JSON string

        new QRCode(document.getElementById("user-qrcode"), {
            text: qrValue,
            width: 200,
            height: 200,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
    });
</script> --}}



