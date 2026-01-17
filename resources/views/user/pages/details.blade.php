@extends('user.layouts.layout')

@section('title', 'User Details')

@section('main-content')
<div class="container mt-4">
    <h3 class="mb-4">Welcome, {{ $user->name }}</h3>

    {{-- Nav Tabs --}}
    <ul class="nav nav-tabs" id="tabMenu" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                type="button" role="tab">Profile</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="qr-tab" data-bs-toggle="tab" data-bs-target="#qr"
                type="button" role="tab">My QR Code</button>
        </li>
    </ul>

    {{-- Tab Content --}}
    <div class="tab-content mt-3">
        {{-- Profile Tab --}}
        <div class="tab-pane fade show active" id="profile" role="tabpanel">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Name:</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone Number:</label>
                    <input type="text" name="phone_number" value="{{ $user->phone_number }}" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>

        {{-- QR Code Tab --}}
        <div class="tab-pane fade" id="qr" role="tabpanel">
            @if ($user->qr_token)
                <div class="mt-4 text-center">
                    <p class="mb-3">Your Token: <strong>{{ $user->qr_token }}</strong></p>
                    <div class="d-inline-block">
                        {!! QrCode::size(200)->generate($user->qr_token) !!}
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('user.download.qr', $user->id) }}" class="btn btn-success me-2">Download QR</a>
                        <button onclick="window.print()" class="btn btn-secondary">Print</button>
                    </div>
                </div>
            @else
                <p class="mt-4 text-danger">QR Code not available.</p>
            @endif
        </div>
    </div>
</div>
@endsection
