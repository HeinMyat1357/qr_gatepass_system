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
                    </div> --}}
                    {{-- <div class="col-sm-6">
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
                                <h3 class="card-title">Add a new user</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">

                                @csrf
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="InputName">Name</label>
                                                <input type="text" name="name" id="InputName" placeholder="Enter name"
                                                    class="form-control text-white" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" name="email" id="exampleInputEmail1"
                                                    placeholder="Enter email" class="form-control text-white" >
                                            </div>
                                        </div>
                                    </div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="InputUserName">User Name</label>
            <input type="text" name="user_name" id="InputUserName"
                   placeholder="Enter username"
                   class="form-control text-white" required>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="InputNRC">NRC Number</label>
            <input type="text" name="nrc_number" id="InputNRC"
                   placeholder="Enter NRC Number"
                   class="form-control text-white" required>
        </div>
    </div>
</div>

{{-- Roll Number (only for students) --}}
<div class="row" id="rollNoRow" style="display: none;">
    <div class="col-6">
        <div class="form-group">
            <label for="InputRollNo">Roll Number</label>
            <input type="text" name="roll_no" id="InputRollNo"
                   placeholder="Enter Roll Number"
                   class="form-control text-white">
        </div>
    </div>
</div>


                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input type="password" name="password" class="form-control text-white"
                                                    id="exampleInputPassword1" placeholder="Password" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="InputPasswordConfirmation">Password Confirmation</label>
                                                <input type="password" name="password_confirmation"
                                                    class="form-control text-white" id="InputPasswordConfirmation"
                                                    placeholder="Password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>User Type</label>
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
                                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endforeach
                                                </select>


                                                {{-- @foreach ($userTypes as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select> --}}
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Role</label>
                                                <select name="role" class="form-control select2" required>
                                                    {{-- <option value="" disabled selected>-- Select Role --</option> --}}
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">{{ ucfirst($role->name) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="InputPhoneNo">Phone Number</label>
                                                <input type="text" name="phone_number" class="form-control text-white"
                                                    id="InputPhoneNo" placeholder="Enter Phone Number">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="customFile">Profile Photo</label>

                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="profile_image"
                                                        id="profile_image" accept="image/*">

                                                    <label class="form-label" for="profile_image"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="verified" value="1"
                                                class="custom-control-input" id="customSwitch1">
                                            <label class="custom-control-label" for="customSwitch1">User is
                                                verified?</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>



                        <!-- /.card -->

                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@push('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
@push('scripts')
<script>
    $(function () {
        $('.select2').select2()
        bsCustomFileInput.init()

        // Show/hide Roll No field depending on user_type_id
        $('select[name="user_type_id"]').on('change', function () {
            if ($(this).val() == 1) { // Assuming 1 = student
                $('#rollNoRow').show();
                $('#InputRollNo').attr('required', true);
            } else {
                $('#rollNoRow').hide();
                $('#InputRollNo').attr('required', false);
            }
        }).trigger('change'); // Trigger on page load
    })
</script>
@endpush
