@extends('moderator.layouts.layout')

@section('title', 'Scan QR Code - QR Code Gate Pass System')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('moderator/css/style.css') }}">
@endpush

@section('main-content')
<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Scanner Card -->
            <div class="card border-0 shadow mb-4">
                <div class="card-header bg-primary text-white d-flex align-items-center">
    <h4 class="mb-0 me-3"><i class="fas fa-camera me-2"></i>Scan QR Code</h4>

    <select name="location_id" id="location_id" class="form-select form-select-sm w-auto ms-auto">
        <option value="">Select Location</option>
        @foreach($locations as $location)
            <option value="{{ $location->id }}">{{ $location->name }}</option>
        @endforeach
    </select>
</div>

                <div class="card-body p-4">
                    <div id="reader" style="width:100%"></div>
                    <div id="scan-result" class="mt-3"></div>
                </div>
            </div>

            <!-- Recent Scans Card -->
            <div class="card border-0 shadow">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Recent Scans</h5>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                     <th>NRC</th>
                                    <th>User Type</th>
                                    <th>Scan Type</th>
{{-- <th>Locations</th> --}}
                                    <th>Scan Time</th>
                                   
                                </tr>
                            </thead>
                            <tbody id="recent-scans-table">
                                <!-- New scan rows will be prepended here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const html5QrCode = new Html5Qrcode("reader");
    let lastScannedCode = null;
    let scanCooldown = false;

    Html5Qrcode.getCameras().then(devices => {
        if (devices && devices.length) {
            html5QrCode.start(
                { facingMode: "environment" },
                { fps: 10, qrbox: 250 },
                (decodedText) => {
                    if (scanCooldown) return; // ignore if cooldown active
                    if (decodedText === lastScannedCode) return; // ignore duplicates quickly

                    lastScannedCode = decodedText;
                    scanCooldown = true;

                    checkQRCode(decodedText);

                    // Cooldown period to prevent multiple triggers on same code
                    setTimeout(() => {
                        scanCooldown = false;
                    }, 3000); // 3 seconds cooldown
                },
                (errorMessage) => {
                    console.warn(`QR Code decode error: ${errorMessage}`);
                }
            );
        } else {
            alert('No cameras found');
        }
    }).catch(err => {
        console.error(err);
        alert('Error getting cameras: ' + err);
    });

    function addScanToRecent(user, status) {
        const recentTableBody = document.getElementById("recent-scans-table");
        const timeNow = new Date().toLocaleString();

        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${user ? user.name : 'N/A'}</td>
            <td>${user ? user.nrc_number : 'N/A'}</td>
            <td>${user ? user.user_type : 'N/A'}</td>
             <td>${user ? user.scan_type : 'N/A'}</td>
             
            <td>${timeNow}</td>
        `;

        recentTableBody.prepend(row);
    }

    function checkQRCode(qrCode) {
    // Get selected location
    const locationSelect = document.getElementById('location_id');
    const locationId = locationSelect.value;

    if (!locationId) {
        alert('Please select a location before scanning.');
        return;
    }

    fetch("{{ route('check.qrcode') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ 
            qr_code: qrCode.trim(),
            location_id: locationId // send location to controller
        })
    })
    .then(res => res.json())
    .then(data => {
        const resultDiv = document.getElementById("scan-result");
        if (data.status === "success") {
            resultDiv.innerHTML = `<div class="alert alert-success">
                ✅ User Found: <strong>${data.user.name}</strong> (${data.user.nrc_number})<br>
                User Type: ${data.user.user_type}
            </div>`;
            addScanToRecent(data.user, 'Success');
        } else {
            resultDiv.innerHTML = `<div class="alert alert-danger">
                ❌ ${data.message}
            </div>`;
            addScanToRecent(null, 'Failed');
        }
    })
    .catch(err => {
        console.error(err);
        const resultDiv = document.getElementById("scan-result");
        resultDiv.innerHTML = `<div class="alert alert-danger">
            ❌ Error checking QR code.
        </div>`;
        addScanToRecent(null, 'Error');
    });
}

});

</script>
@endpush
