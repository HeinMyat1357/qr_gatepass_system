@extends('admin.layout.layout')
@section('title', 'Edit Location')
@section('main-content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                {{-- <div class="col-sm-6">
                    <h5>Edit Location</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('locations.index') }}">Back to Locations</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div> --}}
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Form column -->
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Update Location</h3>
                        </div>

                        <form action="{{ route('locations.update', $location->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                {{-- Name --}}
                                <div class="form-group">
                                    <label for="name">Location Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $location->name) }}" required>
                                </div>

                                {{-- Location Type --}}
                                {{-- <div class="form-group">
                                    <label>Location Type</label>
                                    <select class="form-control select2" name="type" required>
                                        <option value="classroom" {{ $location->type == 'classroom' ? 'selected' : '' }}>Classroom</option>
                                        <option value="office" {{ $location->type == 'office' ? 'selected' : '' }}>Office</option>
                                        <option value="facility" {{ $location->type == 'facility' ? 'selected' : '' }}>Facility</option>
                                        <option value="other" {{ $location->type == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div> --}}

                                {{-- Description --}}
                                {{-- <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="3">{{ old('description', $location->description) }}</textarea>
                                </div> --}}

                                {{-- Access Level Required --}}
                                {{-- <div class="form-group">
                                    <label>Access Level Required</label>
                                    <select class="form-control select2" name="access_level_required" required>
                                        <option value="Teacher" {{ $location->access_level_required == 'Teacher' ? 'selected' : '' }}>Teacher</option>
                                        <option value="Student" {{ $location->access_level_required == 'Student' ? 'selected' : '' }}>Student</option>
                                        <option value="Visitor" {{ $location->access_level_required == 'Visitor' ? 'selected' : '' }}>Visitor</option>
                                    </select>
                                </div> --}}
                            </div>

                            <div class="card-footer">
                                <a href="{{ route('locations.index') }}" class="btn btn-secondary">Back</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger mt-2">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@push('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('scripts')
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            $('.select2').select2();
        });
    </script>
@endpush
