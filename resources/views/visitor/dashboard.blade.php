@extends('visitor.layouts.layout')

@section('title', 'User Dashboard')

@section('main-content')
<div class="container mt-4 mb-5">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Attendance Overview</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="stat-card bg-primary text-white p-3 rounded">
                                <h2 class="stat-number" id="total-users-count">247</h2>
                                <p class="stat-label mb-0">Total Users</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="stat-card bg-success text-white p-3 rounded">
                                <h2 class="stat-number" id="present-today-count">189</h2>
                                <p class="stat-label mb-0">Present Today</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="stat-card bg-warning text-white p-3 rounded">
                                <h2 class="stat-number" id="absent-today-count">58</h2>
                                <p class="stat-label mb-0">Absent Today</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="stat-card bg-info text-white p-3 rounded">
                                <h2 class="stat-number" id="visitors-today-count">12</h2>
                                <p class="stat-label mb-0">Visitors Today</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-8 mb-3 mb-md-0">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Attendance Trends</h5>
                    <select class="form-select form-select-sm" id="attendance-chart-filter">
                        <option value="week">Last 7 Days</option>
                        <option value="month">Last 30 Days</option>
                        <option value="year">This Year</option>
                    </select>
                </div>
                <div class="card-body">
                    <canvas id="attendance-chart" height="250"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Attendance Distribution</h5>
                </div>
                <div class="card-body">
                    <canvas id="distribution-chart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Attendance Records</h5>
                    <button class="btn btn-sm btn-primary" id="refresh-recent-records">
                        <i class="fas fa-sync-alt me-1"></i> Refresh
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Type</th>
                                    <th>Location</th>
                                    <th>Date</th>
                                    <th>Entry Time</th>
                                    <th>Exit Time</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="recent-attendance-table">
                                <!-- Dummy data -->
                                <tr>
                                    <td>John Doe</td>
                                    <td><span class="badge bg-info">Student</span></td>
                                    <td>Main Entrance</td>
                                    <td>2023-06-15</td>
                                    <td>08:15 AM</td>
                                    <td>03:45 PM</td>
                                    <td>7h 30m</td>
                                    <td><span class="badge bg-success">Present</span></td>
                                </tr>
                                <!-- Add more records if needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white text-end">
                    <a href="{{ route('moderator.reports') }}" class="btn btn-outline-primary btn-sm">View All Records</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">User Types Distribution</h5>
                </div>
                <div class="card-body">
                    <canvas id="user-types-chart" height="250"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Attendance by Location</h5>
                </div>
                <div class="card-body">
                    <canvas id="location-chart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Dashboard JS -->
<script src="{{ asset('moderator/js/dashboard.js') }}"></script>
@endpush
