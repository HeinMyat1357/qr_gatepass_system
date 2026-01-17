@extends('moderator.layouts.layout')

@section('title', 'Moderator Dashboard')

@section('main-content')
<div class="container mt-4 mb-5">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white text-primary">
                 <h5 class="mb-0"><i class="fas fa-id-card me-2"></i>Gate Pass Overview</h5>

                </div>
                <div class="card-body">
    <div class="row g-3">
        <div class="col-md-3 col-6">
            <div class="stat-card gradient-blue p-4 rounded text-center shadow-sm">
                <h2 class="stat-number">{{ $user->count() }}</h2>
                <p class="stat-label mb-0">Total Pass Users</p>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-card gradient-green p-4 rounded text-center shadow-sm">
                <h2 class="stat-number">{{ $teacher->count() }}</h2>
                <p class="stat-label mb-0">Total Pass Teachers</p>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-card gradient-yellow p-4 rounded text-center shadow-sm">
                <h2 class="stat-number">{{ $student->count() }}</h2>
                <p class="stat-label mb-0">Total Pass Students</p>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-card gradient-orange p-4 rounded text-center shadow-sm">
                <h2 class="stat-number">{{ $staff->count() }}</h2>
                <p class="stat-label mb-0">Total Pass Staffs</p>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-card gradient-purple p-4 rounded text-center shadow-sm">
                <h2 class="stat-number">{{ $visitor->count() }}</h2>
                <p class="stat-label mb-0">Total Pass Visitors</p>
            </div>
        </div>
    </div>
</div>

            </div>
        </div>
    </div>

    {{-- <div class="row mb-4">
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
    </div> --}}

    <div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-lg rounded-3">
            <div class="card-header bg-gradient text-primary d-flex justify-content-between align-items-center" style="background: linear-gradient(90deg, #4e73df, #1cc88a);">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Recent Gate Pass Records</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th>Name</th>
                                <th>Purpose</th>
                                <th>Location</th>
                                <th>Scan Type</th>
                                <th>Valid From</th>
                                <th>Valid Until</th>
                            </tr>
                        </thead>
                        <tbody id="recent-attendance-table">
                            @foreach($recent as $pass)
                            <tr class="align-middle">
                                <td>{{ $pass->visitor?->visitor_name ?? $pass->user?->name ?? 'N/A' }}</td>
                                <td>{{ $pass->visitor?->purpose ?? 'System Permanent User' }}</td>
                                <td>{{ $pass->location?->name ?? 'N/A' }}</td>
                                <td>{{ $pass->scan_type ?? 'N/A' }}</td>
                                <td>{{ $pass->visitor?->valid_from ?? $pass->user?->created_at ?? 'N/A' }}</td>
                                <td>{{ $pass->visitor?->valid_until ?? 'Not Expired' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
    {{ $recent->links('pagination::bootstrap-5') }}
</div>

                </div>
            </div>
            <div class="card-footer bg-light text-end">
                <a href="{{ route('moderator.visitors') }}" class="btn btn-outline-primary btn-sm me-2">
                    <i class="fas fa-eye me-1"></i> View Visitor Records
                </a>
                <a href="{{ route('moderator.users') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-users me-1"></i> View User Records
                </a>
            </div>
        </div>
    </div>
</div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white text-primary">
                <h5 class="mb-0">User Types Distribution with Pie Chart</h5>
            </div>
            <div class="card-body">
                <canvas id="user-types-chart" height="250"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white text-primary">
                <h5 class="mb-0">Pass by Location with Pie Chart</h5>
            </div>
            <div class="card-body">
                <canvas id="attendance-location-chart" height="250" ></canvas>
            </div>
        </div>
    </div>
    
<div class="row">
<div class="col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white text-primary">
                <h5 class="mb-0">User Types Distribution with Bar Chart</h5>
            </div>
            <div class="card-body">
                <canvas id="attendance-usertype-chart" height="250"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white text-primary">
                <h5 class="mb-0">Pass by Location with Bar Chart</h5>
            </div>
            <div class="card-body">
                <canvas id="location-chart" height="250" ></canvas>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // ===== User Types Chart =====
    new Chart(document.getElementById('user-types-chart'), {
        type: 'pie',
        data: {
            labels: @json($userTypeLabels),
            datasets: [{
                data: @json($userTypeCounts),
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'],
            }]
        }
    });

    // ===== Attendance by Location =====
    new Chart(document.getElementById('location-chart'), {
        type: 'bar',
        data: {
            labels: @json($locationLabels),
            datasets: [{
                
                data: @json($locationCounts),
                backgroundColor: ['#36b9cc','#1cc88a','#f6c23e'],
            }]
        },
        options: {
    responsive: true,
    plugins: {
        legend: {
            display: false
        }
    },
    scales: {
        y: { beginAtZero: true}
    }
}
    });

   new Chart(document.getElementById('attendance-location-chart'), {
    type: 'pie',
    data: {
        labels: @json($locationLabels),
        datasets: [{
            data: @json($locationCounts),
            backgroundColor: ['#36b9cc','#1cc88a','#f6c23e'],
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false, // Allow manual control
    }
});
    
    new Chart(document.getElementById('attendance-usertype-chart'), {
        type: 'bar',
        data: {
            labels: @json($userTypeLabels),
            datasets: [{
                
                data: @json($userTypeCounts),
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
            }]
        },
       options: {
    responsive: true,
    plugins: {
        legend: {
            display: false
        }
    },
    scales: {
        y: { beginAtZero: true  }
    }
}
    });
});
</script>

</div>
@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Dashboard JS -->
<script src="{{ asset('moderator/js/dashboard.js') }}"></script>
@endpush
<style>
/* Gradient Stat Cards */
.stat-card {
    color: #fff;
    font-weight: 600;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    transition: transform 0.3s, box-shadow 0.3s;
}
.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.25);
}

.gradient-blue { background: linear-gradient(135deg, #4e73df, #224abe); }
.gradient-green { background: linear-gradient(135deg, #1cc88a, #138558); }
.gradient-yellow { background: linear-gradient(135deg, #f6c23e, #d4a019); }
.gradient-orange { background: linear-gradient(135deg, #f7941d, #c56200); }
.gradient-purple { background: linear-gradient(135deg, #6f42c1, #4e2c9c); }

.card-header.bg-gradient {
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0.5rem;
    font-weight: 600;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
}

.table-hover tbody tr:hover {
    background: rgba(78, 115, 223, 0.1);
    transform: scale(1.01);
    transition: all 0.2s ease-in-out;
}

.card-footer a.btn-outline-primary:hover {
    color: #fff !important;
    background: linear-gradient(90deg, #4e73df, #1cc88a);
    border-color: #4e73df;
}
</style>
