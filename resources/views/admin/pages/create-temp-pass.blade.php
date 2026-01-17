@extends('admin.layout.layout')
@section('title', 'Add a Temp-pass')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Temporary Pass</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Temporary Pass</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <!-- Display validation errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Success message -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Temporary Pass Form</h3>
                        </div>

                        <form action="{{ route('temp_passes.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                <div class="col-6"> 
                                <div class="form-group">
                                    <label for="visitor_name">Visitor Name</label>
                                    <input type="text" name="visitor_name" class="form-control" required>
                                </div>
                                </div>
                                <div class="col-6"> 
                                <div class="form-group">
                                    <label for="visitor_email">Email</label>
                                    <input type="email" name="visitor_email" class="form-control">
                                </div>
                                </div>
                                </div>

                                <div class="row">
                                <div class="col-6"> 
                                <div class="form-group">
                                    <label for="visitor_phone">Phone</label>
                                    <input type="text" name="visitor_phone" class="form-control">
                                </div>
                                </div>
                                <div class="col-6">
                                <div class="form-group">
                                    <label for="purpose">Purpose</label>
                                    <textarea name="purpose" class="form-control" required></textarea>
                                </div>
                                </div>
                                </div>
                                
                                <div class="row">
                                <div class="col-6"> 
                                <div class="form-group">
                                    <label for="location_id">Location</label>
                                    <select name="location_id" class="form-control select2" required>
                                        <option value="" disabled selected>-- Select Location --</option>
                                        @foreach($locations as $location)
                                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="col-6"> 
                                 <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="pending" selected>Pending</option>
                                        <option value="approved">Approved</option>
                                        <option value="approved">Used</option>
                                        <option value="approved">Expired</option>
                                    </select>
                                </div>
                                </div>
                                </div>

                                <div class="row">
                                <div class="col-6">
                                <div class="form-group">
                                    <label for="valid_from">Valid From</label>
                                    <input type="datetime-local" name="valid_from" class="form-control" required>
                                </div>
                                </div>
                                 <div class="col-6">
                                <div class="form-group">
                                    <label for="valid_until">Valid Until</label>
                                    <input type="datetime-local" name="valid_until" class="form-control" required>
                                </div>
                                </div>
                               
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Create Temp Pass</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(function () {
        $('.select2').select2({
            theme: 'bootstrap4'
        });
    });
</script>
@endpush
