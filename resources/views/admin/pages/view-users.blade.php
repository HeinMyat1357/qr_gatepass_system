@extends('admin.layout.layout')
@section('title', 'View all users')
@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    {{-- <div class="col-sm-6">
            <h1>DataTables</h1>
          </div> --}}
                    {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div> --}}
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Users</h3>
                            </div>
                            <!-- /.card-header -->
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>NRC</th>
                                            {{-- <th>Email</th> --}}
                                            <th>Roll No./ Email</th>
                                            <th>User Type</th>
                                            <th>Phone</th>
                                            {{-- <th>Verified</th> --}}
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->nrc_number }}</td>
                                                {{-- <td>{{ $user->email }}</td> --}}
                                                <td>{{ $user->roll_no ?? $user->email ?? 'N/A' }}</td>
                                                <td>{{ $user->userType->name ?? 'N/A' }}</td>
                                                <td>{{ $user->phone_number ?? 'N/A' }}</td>
                                                {{-- <td>{{ $user->verified ? 'Yes' : 'No' }}</td> --}}
                                                <td>
                                                    @foreach ($user->roles as $role)
                                                        {{ $role->name }}
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <div class="action-btn">
                                                        {{-- Approve button or placeholder --}}
                                                        @if (!$user->verified)
                                                            <form action="{{ route('admin.users.approve', $user->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Approve this user?')">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-success"
                                                                    title="Approve">
                                                                    <i class="fas fa-check"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <div class="btn-placeholder"></div>
                                                        @endif

                                                        {{-- Edit button --}}
                                                        <a href="{{ route('users.edit', $user->id) }}"
                                                            class="btn btn-sm btn-primary" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        {{-- Delete button --}}
                                                        <form action="{{ route('users.destroy', $user->id) }}"
                                                            method="POST" onsubmit="return confirm('Delete this user?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                title="Delete">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>




                                            </tr>
                                        @endforeach
                                    </tbody>
                                    {{-- <tfoot>
                     <tr>
                <th>Name</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Phone</th>
                <th>Verified</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
                  </tfoot> --}}
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@push('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                        extend: 'copy',
                        text: '<span data-bs-toggle="tooltip" title="Copy"><i class="fas fa-copy"></i></span>',
                        className: 'neon-btn'
                    },
                    {
                        extend: 'csv',
                        text: '<span data-bs-toggle="tooltip" title="CSV Export"><i class="fas fa-file-csv"></i></span>',
                        className: 'neon-btn'
                    },
                    {
                        extend: 'excel',
                        text: '<span data-bs-toggle="tooltip" title="Excel Export"><i class="fas fa-file-excel"></i></span>',
                        className: 'neon-btn'
                    },
                    {
                        extend: 'pdf',
                        text: '<span data-bs-toggle="tooltip" title="PDF Export"><i class="fas fa-file-pdf"></i></span>',
                        className: 'neon-btn'
                    },
                    {
                        extend: 'print',
                        text: '<span data-bs-toggle="tooltip" title="Print"><i class="fas fa-print"></i></span>',
                        className: 'neon-btn'
                    },
                    {
                        extend: 'colvis',
                        text: '<span data-bs-toggle="tooltip" title="Columns"><i class="fas fa-columns"></i></span>',
                        className: 'neon-btn'
                    }
                ]

            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    <style>
        /* Neon Button Style for DataTables */
        .neon-btn {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            color: #fff !important;
            font-weight: 600;
            border: none;
            padding: 6px 6px;
            border-radius: 25px;
            margin-right: 5px;
            box-shadow: 0 0 5px #4facfe, 0 0 10px #00f2fe, 0 0 20px #00f2fe;
            transition: all 0.3s ease-in-out;
        }

        .neon-btn:hover {
            box-shadow: 0 0 10px #4facfe, 0 0 20px #00f2fe, 0 0 30px #00f2fe;
            transform: scale(1.05);
        }

        .neon-btn i {
            margin-right: 5px;
        }
    </style>
    <style>
        /* Make DataTables search input text white */
        .dataTables_wrapper .dataTables_filter input {
            color: #fff;
            /* Text color */
            background: #1a1a1a;
            /* Optional: dark input background */
            border: 1px solid #4facfe;
            /* Neon border */
            border-radius: 25px;
            padding: 6px 6px;
            box-shadow: 0 0 5px #4facfe, 0 0 10px #00f2fe;
            transition: all 0.3s ease-in-out;
        }

        .dataTables_wrapper .dataTables_filter input::placeholder {
            color: #bbb;
            /* Optional: placeholder color */
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            outline: none;
            box-shadow: 0 0 10px #4facfe, 0 0 20px #00f2fe;
            background: #111;
        }
    </style>

    <style>
        /* Neon style for pagination buttons */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background: linear-gradient(135deg, #ff6ec4, #7873f5);
            color: #fff !important;
            font-weight: 400;
            border-radius: 20px;
            margin: 2px;
            padding: 6px 6px;
            box-shadow: 0 0 5px #ff6ec4, 0 0 10px #7873f5, 0 0 20px #7873f5;
            transition: all 0.3s ease-in-out;
            cursor: pointer;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            box-shadow: 0 0 10px #ff6ec4, 0 0 20px #7873f5, 0 0 30px #ff6ec4;
            transform: scale(1.1);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, #43e97b, #38f9d7);
            box-shadow: 0 0 10px #38f9d7, 0 0 20px #43e97b, 0 0 30px #38f9d7;
            color: #fff !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
@endpush
<style>
    /* Action buttons container */
    .table td .action-btn {
        display: flex;
        justify-content: space-between;
        /* spread buttons evenly */
        align-items: center;
        width: 120px;
        /* fixed width to align all rows */
    }

    /* Placeholder for missing buttons */
    .btn-placeholder {
        width: 36px;
        height: 36px;
    }

    /* Icon-only neon buttons */
    .table td .btn-sm {
        width: 36px;
        height: 36px;
        padding: 0;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        transition: all 0.2s ease-in-out;
    }

    /* Neon colors */
    .btn-success {
        background-color: #0f0;
        color: #000;
        box-shadow: 0 0 5px #0f0, 0 0 10px #0f0;
    }

    .btn-success:hover {
        box-shadow: 0 0 10px #0f0, 0 0 20px #0f0;
    }

    .btn-primary {
        background-color: #0ff;
        color: #000;
        box-shadow: 0 0 5px #0ff, 0 0 10px #0ff;
    }

    .btn-primary:hover {
        box-shadow: 0 0 10px #0ff, 0 0 20px #0ff;
    }

    .btn-danger {
        background-color: #f00;
        color: #fff;
        box-shadow: 0 0 5px #f00, 0 0 10px #f00;
    }

    .btn-danger:hover {
        box-shadow: 0 0 10px #f00, 0 0 20px #f00;
    }
</style>
