@extends('admin.layout.layout')
@section('title', 'Add a Location')
@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    {{-- <div class="col-sm-6">
                        <h5>Location</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Location</li>
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Create a new location</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('locations.store') }}" method="POST">
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="InputName">Name</label>
                    <input type="text" name="name" class="form-control" id="InputName" placeholder="Enter name" required>
                </div>
            </div>
            {{-- <div class="col-6">
                <div class="form-group">
                    <label>Location Type</label>
                    <select name="type" class="form-control select2" required>
                        <option value="classroom">Classroom</option>
                        <option value="office">Office</option>
                        <option value="facility">Facility</option>
                        <option value="library">Library</option>
                        <option value="canteen">Canteen</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div> --}}
        </div>

        {{-- <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Access Level Required</label>
                    <select name="access_level_required" class="form-control select2">
                        <option value="teacher">Teacher</option>
                        <option value="student">Student</option>
                        <option value="visitor">Visitor</option>
                        <option value="">None</option>
                    </select>
                </div>
            </div>
        </div> --}}
    </div>

    <!-- Submit -->
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
