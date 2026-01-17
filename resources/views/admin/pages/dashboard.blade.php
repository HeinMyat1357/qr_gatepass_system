@extends('admin.layout.layout')

@section('main-content')
    <div class="content-wrapper"
        style="background: linear-gradient(to right, #1e3c72, #2a5298); min-height: 100vh; padding: 30px 15px;">

        <!-- Header -->
        <div class="content-header mb-4 text-white">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="m-0">Dashboard</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 m-0">
                        {{-- <li class="breadcrumb-item"><a href="#" class="text-white">Home</a></li> --}}
                        {{-- <li class="breadcrumb-item active text-white" aria-current="page">Dashboard</li> --}}
                    </ol>
                </nav>
            </div>
        </div>

        <div class="container-fluid">

            <!-- Stat Boxes -->
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card text-white shadow-lg"
                        style="background: linear-gradient(135deg,#00c6ff,#0072ff); border-radius: 15px;">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h3>{{ $all_users->count() }}</h3>
                                <p>All Users</p>
                            </div>
                            <i class="fas fa-users fa-3x opacity-75"></i>
                        </div>
                        <a href="/view-users"
                            class="card-footer text-white text-decoration-none d-block bg-dark bg-opacity-25 rounded-bottom">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card text-white shadow-lg"
                        style="background: linear-gradient(135deg,#28a745,#85e085); border-radius: 15px;">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h3>{{ $unverified_users->count() }}</h3>
                                <p>Unverified Users</p>
                            </div>
                            <i class="fas fa-user-clock fa-3x opacity-75"></i>
                        </div>
                        <a href="/view-users"
                            class="card-footer text-white text-decoration-none d-block bg-dark bg-opacity-25 rounded-bottom">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card text-white shadow-lg"
                        style="background: linear-gradient(135deg,#ffc107,#ffeb3b); border-radius: 15px;">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h3>{{ $verified_users->count() }}</h3>
                                <p>Verified Users</p>
                            </div>
                            <i class="fas fa-user-check fa-3x opacity-75"></i>
                        </div>
                        <a href="/view-users"
                            class="card-footer text-white text-decoration-none d-block bg-dark bg-opacity-25 rounded-bottom">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card text-white shadow-lg"
                        style="background: linear-gradient(135deg,#dc3545,#ff6f61); border-radius: 15px;">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h3>{{ $visitor->count() }}</h3>
                                <p>Visitors</p>
                            </div>
                            <i class="fas fa-user-friends fa-3x opacity-75"></i>
                        </div>
                        <a href="/view-temp-passes"
                            class="card-footer text-white text-decoration-none d-block bg-dark bg-opacity-25 rounded-bottom">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Row -->
            <div class="row">
                <!-- Left Column: Charts -->
                <section class="col-lg-6 mb-4">
                    <div class="card shadow-lg"
                        style="border-radius: 15px; background: white; backdrop-filter: blur(10px);">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-blue"><i class="fas fa-chart-line me-2"></i> User Insights</h3>
                            <ul class="nav nav-pills ml-auto">
                                {{-- Tabs if needed --}}
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <div class="chart tab-pane active" id="revenue-chart" style="height: 300px;">
                                    <canvas id="revenue-chart-canvas" height="300"></canvas>
                                </div>
                                <div class="chart tab-pane" id="sales-chart" style="height: 300px;">
                                    <canvas id="sales-chart-canvas" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Right Column: Calendar -->
                <section class="col-lg-6 mb-4">
                    <div class="card shadow-lg" style="border-radius: 15px; background:white; backdrop-filter: blur(10px);">
                        <div class="card-header text-blue border-0">
                            <h3 class="card-title"><i class="far fa-calendar-alt me-2"></i> Calendar</h3>
                        </div>
                        <div class="card-body pt-0">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Recent Users Table -->
            <div class="card shadow-lg"
                style="border-radius: 15px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px);">
                <div class="card-header text-white">
                    <h3 class="card-title"><i class="fas fa-users me-2"></i> Unapproved Users</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-white align-middle">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>NRC No.</th>
                                <th>User Type</th>
                                <th>Phone</th>
                                <th>Verified</th>
                                <th>Role</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recent_users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->nrc_number ?? 'N/A' }}</td>
                                    <td>{{ $user->userType->name ?? 'N/A' }}</td>
                                    <td>{{ $user->phone_number ?? 'N/A' }}</td>
                                    <td>{{ $user->verified ? 'Yes' : 'No' }}</td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            {{ $role->name }}{{ !$loop->last ? ',' : '' }}
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            {{-- Approve button (only show if not verified) --}}
                                            @if (!$user->verified)
                                                <form action="{{ route('admin.users.approve', $user->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button class="neon-btn neon-green" id="neo" title="Approve">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            @endif

                                            {{-- Edit button --}}
                                            <a href="{{ route('users.edit', $user->id) }}" class="neon-btn neon-blue"
                                                id="neo" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            {{-- Delete button --}}
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="neon-btn neon-red" id="neo" title="Delete">
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

        </div>

    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- FullCalendar -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <script>
        // Line Chart
        const ctxRevenue = document.getElementById('revenue-chart-canvas').getContext('2d');
        new Chart(ctxRevenue, {
            type: 'line',
            data: {
                labels: @json($months),
                datasets: [{
                    label: 'Users Registered',
                    data: @json($counts),
                    borderColor: '#00c6ff',
                    backgroundColor: 'rgba(0,198,255,0.3)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Donut Chart
        const ctxSales = document.getElementById('sales-chart-canvas').getContext('2d');
        new Chart(ctxSales, {
            type: 'doughnut',
            data: {
                labels: @json($roles),
                datasets: [{
                    data: @json($roleCounts),
                    backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Calendar
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($calendarEvents),
                themeSystem: 'standard'
            }).render();
        });
    </script>

    <style>
        /* Table style */
        .table-hover tbody tr:hover {
            background-color: white;
        }

        .table thead th {
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
        }

        #neo {
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            color: #fff;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s ease-in-out;
        }

        /* .neon-btn {
                            border: none;
                            width: 30px;
                            height: 30px;
                            border-radius: 50%;
                            color: #fff;
                            font-size: 14px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            transition: 0.3s ease-in-out;
                        } */

        .neon-green {
            background: #0f0;
            box-shadow: 0 0 8px #0f0, 0 0 15px #0f0;
        }

        .neon-green:hover {
            box-shadow: 0 0 15px #0f0, 0 0 30px #0f0;
            transform: scale(1.1);
        }

        .neon-blue {
            background: #0ff;
            box-shadow: 0 0 8px #0ff, 0 0 15px #0ff;
        }

        .neon-blue:hover {
            box-shadow: 0 0 15px #0ff, 0 0 30px #0ff;
            transform: scale(1.1);
        }

        .neon-red {
            background: #f00;
            box-shadow: 0 0 8px #f00, 0 0 15px #f00;
        }

        .neon-red:hover {
            box-shadow: 0 0 15px #f00, 0 0 30px #f00;
            transform: scale(1.1);
        }
    </style>
@endsection
