@extends('admin.layout.layout')
@section('title', 'Edit Temporary Pass')

@section('main-content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Edit Temporary Pass</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('temp_passes.update', $pass->id) }}" method="POST" >
                @csrf
                @method('PUT')

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Visitor Name</label>
                                    <input type="text" name="visitor_name" value="{{ $pass->visitor_name }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Visitor Email</label>
                                    <input type="email" name="visitor_email" value="{{ $pass->visitor_email }}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Visitor Phone</label>
                                    <input type="text" name="visitor_phone" value="{{ $pass->visitor_phone }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Purpose</label>
                                    <textarea name="purpose" class="form-control" rows="2">{{ $pass->purpose }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Location</label>
                                    <select name="location_id" class="form-control" required>
                                        @foreach($locations as $location)
                                            <option value="{{ $location->id }}" {{ $location->id == $pass->location_id ? 'selected' : '' }}>
                                                {{ $location->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="pending" {{ $pass->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ $pass->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="used" {{ $pass->status == 'used' ? 'selected' : '' }}>Used</option>
                                        <option value="expired" {{ $pass->status == 'expired' ? 'selected' : '' }}>Expired</option>
                                    </select>
                                </div>
                            </div> --}}
                        </div>

                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Valid From</label>
                                    <input type="datetime-local" name="valid_from" value="{{ \Carbon\Carbon::parse($pass->valid_from)->format('Y-m-d\TH:i') }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Valid Until</label>
                                    <input type="datetime-local" name="valid_until" value="{{ \Carbon\Carbon::parse($pass->valid_until)->format('Y-m-d\TH:i') }}" class="form-control" required>
                                </div>
                            </div>
                        </div> --}}
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('temp_passes.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
