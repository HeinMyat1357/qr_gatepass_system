@extends('admin.layout.layout')
@section('title', 'Edit User Type')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1>Edit User Type</h1> --}}
                </div>
                {{-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user_types.index') }}">User Types</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div> --}}
            </div>
        </div>
    </section>

    <!-- Main form content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Update User Type</h3>
                        </div>

                        <form action="{{ route('user_types.update', $userType->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">User Type Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                           placeholder="Enter user type name" value="{{ old('name', $userType->name) }}" required>
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="card-footer">
                                <a href="{{ route('user_types.index') }}" class="btn btn-secondary">Back</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
