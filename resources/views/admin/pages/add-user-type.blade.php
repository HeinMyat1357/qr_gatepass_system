@extends('admin.layout.layout')
@section('title', 'Add a User Type')
@section('main-content')
    <style>
        /* Neon Theme */
        body {
            background: #0d0d0d;
            font-family: 'Segoe UI', sans-serif;
            color: #fff;
        }

        .neon-card {
            background: #111;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 255, 170, 0.5), 0 0 30px rgba(0, 200, 255, 0.3);
            padding: 20px;
            transition: all 0.3s ease-in-out;
        }

        .neon-card:hover {
            box-shadow: 0 0 25px rgba(0, 255, 170, 0.8), 0 0 50px rgba(0, 200, 255, 0.5);
            transform: scale(1.02);
        }

        .neon-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #0ff;
            text-shadow: 0 0 5px #0ff, 0 0 10px #0ff;
        }

        label {
            color: #fff;
            font-weight: 500;
            text-shadow: 0 0 3px #0ff;
        }

        .form-control {
            background: #000;
            border: 1px solid #0ff;
            border-radius: 10px;
            color: #0ff;
            padding: 10px;
        }

        .form-control:focus {
            outline: none;
            box-shadow: 0 0 15px #0ff;
            border-color: #00ffaa;
        }

        .btn-neon {
            background: #0ff;
            color: #000;
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 0 10px #0ff, 0 0 20px #0ff;
        }

        .btn-neon:hover {
            background: #00ffaa;
            box-shadow: 0 0 20px #00ffaa, 0 0 40px #00ffaa;
            transform: translateY(-2px);
        }

        .alert-success {
            background: rgba(0, 255, 170, 0.2);
            color: #0ff;
            border: 1px solid #0ff;
            border-radius: 10px;
            text-shadow: 0 0 5px #0ff;
        }
    </style>

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        @if (session('success'))
                            <div class="alert alert-success text-center">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="neon-card ">
                            <h3 class="neon-title mb-4">➕ Add a New User Type</h3>
                            <form action="{{ route('user_types.store') }}" method="POST" class="text-white">
                                @csrf
                                <div class="form-group">
                                    <label for="InputUserType">User Type Name:</label>
                                    <input type="text" name="name" class="form-control text-white" id="InputUserType"
                                        placeholder="Enter User Type Name" required>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn-neon">🚀 Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
