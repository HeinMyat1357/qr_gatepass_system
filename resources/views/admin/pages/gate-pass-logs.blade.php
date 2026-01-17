@extends('admin.layout.layout')
@section('title', 'Gate Pass Logs')

@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                {{-- <h5>All Gate Pass Logs</h5> --}}
            </div>
        </section>

        <!-- Flash Message -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Gate Pass Logs</h3>
                            </div>

                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped text-center align-middle">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Location</th>
                                            <th>Scan Type</th>
                                            <th>Scan Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($gate as $pass)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($pass->user)
                                                        {{ $pass->user->name }}
                                                    @elseif($pass->visitor)
                                                        {{ $pass->visitor->visitor_name }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>{{ $pass->userType->name ?? 'N/A' }}</td>
                                                <td>{{ $pass->location->name }}</td>
                                                <td>{{ $pass->scan_type }}</td>
                                                <td>{{ $pass->scanned_at }}</td>
                                                <td>
                                                    <div class="action-btn d-flex justify-content-center gap-2">
                                                        {{-- Delete button --}}
                                                        <form action="{{ route('gate_pass_logs.destroy', $pass->id) }}"
                                                            method="POST" onsubmit="return confirm('Delete this log?')">
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
                                </table>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <style>
        /* Neon Buttons for DataTables Export */
        .neon-btn {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            color: #fff !important;
            font-weight: 600;
            border: none;
            padding: 6px 10px;
            border-radius: 25px;
            margin-right: 5px;
            box-shadow: 0 0 5px #4facfe, 0 0 10px #00f2fe, 0 0 20px #00f2fe;
            transition: all 0.3s ease-in-out;
        }

        .neon-btn:hover {
            box-shadow: 0 0 10px #4facfe, 0 0 20px #00f2fe, 0 0 30px #00f2fe;
            transform: scale(1.05);
        }

        /* DataTables search input */
        .dataTables_wrapper .dataTables_filter input {
            color: #fff;
            background: #1a1a1a;
            border: 1px solid #4facfe;
            border-radius: 25px;
            padding: 6px 12px;
            box-shadow: 0 0 5px #4facfe, 0 0 10px #00f2fe;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            box-shadow: 0 0 10px #4facfe, 0 0 20px #00f2fe;
            background: #111;
        }

        /* Neon pagination buttons */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background: linear-gradient(135deg, #ff6ec4, #7873f5);
            color: #fff !important;
            border-radius: 20px;
            margin: 2px;
            padding: 6px 10px;
            box-shadow: 0 0 5px #ff6ec4, 0 0 10px #7873f5;
            transition: 0.3s;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            transform: scale(1.1);
            box-shadow: 0 0 10px #ff6ec4, 0 0 20px #7873f5;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, #43e97b, #38f9d7);
            box-shadow: 0 0 20px #38f9d7;
        }

        /* Table action buttons */
        .table td .action-btn .btn-sm {
            width: 36px;
            height: 36px;
            padding: 0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .btn-danger {
            background-color: #f00;
            color: #fff;
            box-shadow: 0 0 5px #f00, 0 0 10px #f00;
        }
    </style>
@endpush

@push('scripts')
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
        });
    </script>
@endpush
