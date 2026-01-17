@extends('moderator.layouts.layout')

@section('title', 'Users Management')

@section('main-content')
<div class="container mt-4 mb-5">
    <div class="card border-0 shadow-sm">
        {{-- <div class="card-header bg-primary text-white d-flex align-items-center">
            <i class="fas fa-user-friends me-2"></i>
            <h5 class="mb-0">Users Management</h5>
        </div> --}}
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                              <th>NRC</th>
                                <th>Email / Roll No</th>
                            <th>Location</th>
                            <th>Scan Type</th>
                            <th>Scan Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user as $pass)
                        <tr class="table-row-effect">
                         <td>{{ $pass->user->name ?? 'N/A' }}</td>
<td>
    @if($pass->user && $pass->user->userType)
        <span class="badge 
            @if($pass->user->userType->name == 'Student') bg-warning 
            @elseif($pass->user->userType->name == 'Teacher') bg-success
            @elseif($pass->user->userType->name == 'Staff') bg-info 
            @else bg-primary @endif">
            {{ $pass->user->userType->name }}
        </span>
    @else
        <span class="badge bg-secondary">N/A</span>
    @endif
</td>
<td>{{ $pass->user->nrc_number ?? 'N/A' }}</td>
<td>{{  $pass->user->roll_no ?? $pass->user->email ?? 'N/A'  }}</td>
                            <td>{{ $pass->location->name ?? 'N/A' }}</td>
                            <td>
                                <span class="badge 
                                    @if($pass->scan_type == 'entry') bg-success
                                    @elseif($pass->scan_type == 'exit') bg-danger
                                    @else bg-info @endif">
                                    {{ ucfirst($pass->scan_type ?? 'N/A') }}
                                </span>
                            </td>
                            <td>{{ $pass->scanned_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-center bg-white">
            {{ $user->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Table hover effect */
.table-row-effect {
    transition: all 0.3s ease;
}

.table-row-effect:hover {
    background-color: #f0f8ff; /* soft info highlight */
    transform: scale(1.02);
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.15);
}

/* Badges for User Types */
.badge.bg-warning { background-color: #f6c23e; color: #fff; } /* Students */
.badge.bg-success { background-color: #1cc88a; color: #fff; } /* Teachers */
.badge.bg-info { background-color: #36b9cc; color: #fff; }    /* Staff */
.badge.bg-primary { background-color: #4e73df; color: #fff; } /* Default */

/* Badges for Scan Type */
.badge.bg-danger { background-color: #e74a3b; color: #fff; }  /* Exit */
.badge.bg-info { background-color: #36b9cc; color: #fff; }    /* Other scan types */

/* Table header */
.table-light th {
    background-color: #4e73df; /* primary dashboard color */
    color: #fff;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Card header icon */
.card-header i {
    font-size: 1.2rem;
}

/* Card rounding */
.card {
    border-radius: 0.75rem;
}
</style>
@endpush
