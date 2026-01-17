@extends('visitor.layouts.layout')

@section('title', 'Visitor Profile')

@section('main-content')
@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::guard('visitor')->user();
@endphp

@if (!$user)
    <div class="alert alert-danger mt-5 text-center">
        You are not logged in. Please <a href="{{ route('login.test') }}">log in</a> to access your profile.
    </div>
@else
<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow">
                <div class="card-header text-info text-center bg-gray">
                    <h4 class="mb-0"><i class="fas fa-id-card me-2"></i>Visitor Profile</h4>
                </div>
                <div class="card-body p-4">
                    {{-- Profile Info --}}
                    <div class="row mb-4">
                        <div class="col-md-3 text-center mb-3 mb-md-0">
                            <div class="profile-image-container position-relative">
                               <img src="{{ $user->profile_image 
                                    ? asset('uploads/profile_images/' . $user->profile_image)
                                    : 'https://placehold.co/120x120.png?text=No+Image' }}" 
                                    alt="Profile Image"
                                    class="rounded-circle"
                                    style="width: 120px; height: 120px; object-fit: cover; object-position: center;">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <h3>{{ $user->visitor_name }}</h3>
                            <p class="mb-2">
                                <span class="badge bg-info">Visitor</span>
                            </p>
                            <div class="mb-2"><i class="fas fa-envelope me-2 text-muted"></i>{{ $user->visitor_email }}</div>
                            <div class="mb-2"><i class="fas fa-phone me-2 text-muted"></i>{{ $user->visitor_phone ?? 'N/A' }}</div>
                            {{-- <div class="mb-2"><i class="fas fa-building me-2 text-muted"></i>{{ $user->department ?? 'N/A' }}</div> --}}
                        </div>
                    </div>

                    {{-- Success / Error --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @elseif(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    {{-- ✅ FORM: Update Profile --}}
                   <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $user->visitor_name }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="{{ $user->visitor_email }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="phone_number" class="form-label">Phone</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $user->visitor_phone }}" disabled>
                            </div>
                              <!-- ✅ ✅ ✅ Add this profile image field here -->
                                {{-- <div class="col-md-6">
                                    <label for="profile_image" class="form-label">Update Profile Photo</label>
                                    <input type="file" class="form-control" id="profile_image" name="profile_image" accept="image/*">
                                </div> --}}
                        </div>

                        {{-- <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4"> --}}
                            {{-- <button type="reset" class="btn btn-outline-secondary">Reset</button> --}}
                            {{-- <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div> --}}
                    </form>

                    {{-- ✅ FORM: Change Password --}}
                    {{-- <hr>
                    <h5 class="mt-4">Change Password</h5>

                    <form method="POST" action="{{ route('profile.changePassword') }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" name="new_password" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" name="new_password_confirmation" class="form-control" required>
                        </div>

                        @if(session('password_success'))
                            <div class="alert alert-success">{{ session('password_success') }}</div>
                        @elseif(session('password_error'))
                            <div class="alert alert-danger">{{ session('password_error') }}</div>
                        @endif

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-warning">Change Password</button>
                        </div> --}}
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection


@push('scripts')
<script src="{{ asset('moderator/js/profile.js') }}"></script>
@endpush
<style>
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