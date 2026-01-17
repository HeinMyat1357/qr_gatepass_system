@extends('moderator.layouts.layout')

@section('title', 'Visitors Management')

@section('main-content')
<section class="content">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm mb-4">
            {{-- <div class="card-header bg-primary text-white d-flex align-items-center"> --}}
                {{-- <i class="fas fa-users me-2"></i> --}}
                {{-- <h5 class="mb-0">Visitors Management</h5> --}}
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Purpose</th>
                        
                                     <th>NRC</th>
                
                                    <th>Scan Type</th>
<th>Locations</th>
                    
                                   
                                <th>Valid From</th>
                                <th>Valid Until</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($visitor as $pass)
                            <tr class="table-row-effect">
                                <td>{{ $pass->visitor->visitor_name ?? 'N/A' }}</td>
                                <td>{{ $pass->visitor->purpose ?? 'N/A' }}</td>
                                <td>{{ $pass->visitor->nrc_number ?? 'N/A' }}</td>
                              
                                <td>
                                    <span class="badge 
                                        @if($pass->scan_type == 'entry') bg-success 
                                        @elseif($pass->scan_type == 'exit') bg-danger 
                                        @else bg-info 
                                        @endif">
                                        {{ ucfirst($pass->scan_type ?? 'N/A') }}
                                    </span>
                                </td>
                                  <td>{{ $pass->location->name ?? 'N/A' }}</td>
                                <td>{{ $pass->visitor->valid_from ?? 'N/A' }}</td>
                                <td>{{ $pass->visitor->valid_until ?? 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center bg-white">
                {{ $visitor->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
/* Hover effect for rows */
.table-row-effect {
    transition: all 0.3s ease;
}

.table-row-effect:hover {
    background-color: #f0f8ff; /* light info color */
    transform: scale(1.02);
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.2);
}

/* Badges */
.badge.bg-success { background-color: #1cc88a; }
.badge.bg-danger { background-color: #e74a3b; }
.badge.bg-info { background-color: #36b9cc; }

/* Table header */
.table-light th {
    background-color: #4e73df; /* primary dashboard color */
    color: #fff;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Card shadows */
.card {
    border-radius: 0.75rem;
}

.card-header i {
    font-size: 1.2rem;
}
</style>
@endpush
