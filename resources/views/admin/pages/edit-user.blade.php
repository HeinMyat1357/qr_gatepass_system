@extends('admin.layout.layout')
@section('title', 'Add a user')
@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    {{-- <div class="col-sm-6">
                        <h1>User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                    </div> --}}
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <!-- general form elements -->
                        <div class="card ">
                            <div class="card-header">
                                <h3 class="card-title">Update user</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('users.update', $user->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    {{-- Name and Email --}}
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Name:</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $user->name }}" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Email:</label>
                                                <input type="email" name="email" class="form-control"
                                                    value="{{ $user->email }}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Phone and User Type --}}
                                    {{-- Phone and Roll Number --}}
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label>Phone:</label>
            <input type="text" name="phone_number" class="form-control"
                value="{{ $user->phone_number }}">
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>Roll Number:</label>
            <input type="text" name="roll_no" class="form-control"
                value="{{ $user->roll_no }}">
        </div>
    </div>
</div>
                                        <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>User Type:</label>
                                                <style>
                                                    /* Base dark select style */
                                                    .form-control.select2 {
                                                        background-color: #1a1a1a;
                                                        color: #ffffff;
                                                        border: 1px solid #333;
                                                        border-radius: 8px;
                                                        padding: 0 12px;
                                                        /* horizontal padding */
                                                        height: 30px;
                                                        /* desired height */
                                                        line-height: 30px;
                                                        /* vertically center text */
                                                        box-shadow: 0 0 5px rgba(255, 255, 255, 0.2) inset;
                                                        text-align: center;
                                                        /* horizontal center */
                                                    }

                                                    /* Focused select */
                                                    .form-control.select2:focus {
                                                        border-color: #0ff;
                                                        box-shadow: 0 0 8px #0ff inset;
                                                        outline: none;
                                                    }

                                                    /* Options inside the dropdown */
                                                    .form-control.select2 option {
                                                        background-color: #1a1a1a;
                                                        color: #ffffff;
                                                        text-align: center;
                                                    }

                                                    /* Select2 container adjustments */
                                                    .select2-container .select2-selection--single {
                                                        height: 30px;
                                                        /* match select height */
                                                        line-height: 30px;
                                                        /* vertically center text */
                                                        background-color: #1a1a1a;
                                                        border-radius: 8px;
                                                        text-align: center;
                                                        border: 1px solid #333;
                                                    }

                                                    .select2-container--default .select2-selection--single .select2-selection__rendered {
                                                        line-height: 20px;
                                                        /* center selected text vertically */
                                                        text-align: center;
                                                        /* center horizontally */
                                                        color: #fff;
                                                    }

                                                    .select2-container--default .select2-selection--single .select2-selection__arrow {
                                                        height: 20px;
                                                        /* vertically center arrow */
                                                    }
                                                </style>
                                                <select name="user_type_id" class="form-control select2" required>
                                                    @foreach ($userTypes as $type)
                                                        <option value="{{ $type->id }}"
                                                            {{ $user->user_type_id == $type->id ? 'selected' : '' }}>
                                                            {{ $type->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    

                                    {{-- Role and Verified --}}
                                    
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Role:</label>
                                                <select name="role" class="form-control select2" required>
                                                    <option value="1" {{ $userRoleId == 1 ? 'selected' : '' }}>Admin
                                                    </option>
                                                    <option value="2" {{ $userRoleId == 2 ? 'selected' : '' }}>
                                                        Moderator</option>
                                                    <option value="3" {{ $userRoleId == 3 ? 'selected' : '' }}>User
                                                    </option>
                                                </select>

                                            </div>
                                        </div>
                                </div>

                                        {{-- <div class="col-6">
                                            <div class="form-group">
                                                <label>Verified:</label><br>
                                                <input type="hidden" name="verified" value="0">
                                                <input type="checkbox" name="verified" value="1"
                                                    {{ $user->verified ? 'checked' : '' }}> Verified
                                            </div>
                                        </div> --}}
                                    </div>

                                    {{-- Submit --}}
                                    <div class="card-footer">
                                        <a href="{{ route('users.view') }}" class="btn btn-secondary">Back</a>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>

                                    {{-- Validation Errors --}}
                                    @if ($errors->any())
                                        <div class="alert alert-danger mt-2">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                @endsection
                @push('styles')
                    <!-- Select2 -->
                    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
                    <link rel="stylesheet"
                        href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
                @endpush

                @push('scripts')
                    <!-- Select2 -->
                    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
                    <!-- bs-custom-file-input -->
                    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

                    <!-- Page specific script -->
                    <script>
                        $(function() {
                            //Initialize Select2 Elements
                            $('.select2').select2()

                            bsCustomFileInput.init()
                        })
                    </script>
                @endpush
