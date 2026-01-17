@extends('admin.layout.layout')
@section('title', 'View all User Types')

@section('main-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    {{-- <div class="col-sm-6">
                    <h1>User Types</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Types</li>
                    </ol>
                </div> --}}
                </div>
            </div>
        </section>
        <!-- Success message -->
        @if (session('success'))
            <div class="alert alert-success mx-3">
                {{ session('success') }}
            </div>
        @endif
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All User Types</h3>
                    </div>
                    <div class="card-body">
                        <table id="userTypesTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>User Type Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userTypes as $type)
                                    <tr>
                                        {{-- <td>{{ $type->id }}</td> --}}
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $type->name }}</td>
                                        <td>
                                            <div class="action-btn d-flex justify-content-center align-items-center">
                                                {{-- Edit button --}}
                                                <a href="{{ route('user_types.edit', $type->id) }}"
                                                    class="btn btn-sm btn-primary mx-1" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                {{-- Delete button --}}
                                                <form action="{{ route('user_types.destroy', $type->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this user type?');"
                                                    class="mx-1">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>


                                    </tr>
                                @endforeach
                            </tbody>
                            {{-- <tfoot>
                            <tr> --}}
                            {{-- <th>ID</th> --}}
                            {{-- <th>User Type Name</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot> --}}
                        </table>
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
            // Neon-themed DataTable
            $("#userTypesTable").DataTable({
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
            }).buttons().container().appendTo('#userTypesTable_wrapper .col-md-6:eq(0)');

            // Initialize Bootstrap tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
    </script>

    <style>
        /* Neon Button Style for DataTables */
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

        .neon-btn i {
            margin-right: 5px;
        }

        /* DataTables Search Input - Neon */
        .dataTables_wrapper .dataTables_filter input {
            color: #fff;
            background: #1a1a1a;
            border: 1px solid #4facfe;
            border-radius: 25px;
            padding: 6px 12px;
            box-shadow: 0 0 5px #4facfe, 0 0 10px #00f2fe;
            transition: all 0.3s ease-in-out;
        }

        .dataTables_wrapper .dataTables_filter input::placeholder {
            color: #bbb;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            outline: none;
            box-shadow: 0 0 10px #4facfe, 0 0 20px #00f2fe;
            background: #111;
        }

        /* Neon Pagination Buttons */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background: linear-gradient(135deg, #ff6ec4, #7873f5);
            color: #fff !important;
            font-weight: 400;
            border-radius: 20px;
            margin: 2px;
            padding: 6px 10px;
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
            font-size: 16px;

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

        /* Action buttons in table rows - Neon icons */
    </style>
@endpush
