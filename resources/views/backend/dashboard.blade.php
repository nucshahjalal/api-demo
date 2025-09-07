@extends('backend.app')
@section('page_title','SMS')
@section('content')
<main  class="nxl-container">
    <div  class="nxl-content">
    <!-- [ page-header ] start -->
    <div  class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Dashboard</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Dashboard</li>
            </ul>
        </div>
        <div class="page-header-right ms-auto">
            <div class="page-header-right-items">
                <div class="d-flex d-md-none">
                    <a href="javascript:void(0)" class="page-header-right-close-toggle">
                        <i class="feather-arrow-left me-2"></i>
                        <span>Back</span>
                    </a>
                </div>
                <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                    <!-- <div id="reportrange" class="reportrange-picker d-flex align-items-center">
                        <span class="reportrange-picker-field"></span>
                    </div> -->
                    <div class="dropdown filter-dropdown">
                        <div class="page-header-right ms-auto">
                            <form method="get" action="{{ url('/dashboard') }}" id="submitForm">
                                @csrf
                                <div class="d-flex align-items-center gap-2">
                                    <select style="font-size:16px;" class="form-control form-control-lg" name="vehicle_id" id="vehicle_id" data-select2-selector="icon">
                                        <option style="font-size:15px;" value="">&#128269; -- Select --</option> 
                                        @foreach($vehicles as $obj) 
                                            <option style="font-size:15px;" value="{{ $obj->id }}"{{ request('vehicle_id') == $obj->id ? 'selected' : '' }}>{{ date('d-M-Y', strtotime($obj->created_at)) }}</option>
                                        @endforeach 
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-md-none d-flex align-items-center">
                <a href="javascript:void(0)" class="page-header-right-open-toggle">
                    <i class="feather-align-right fs-20"></i>
                </a>
            </div>
        </div>
    </div>

<div class="main-content">  
    <div class="row">
       
        <div class="col-xxl-6 col-md-6">
            <div class="card stretch stretch-full">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between mb-4">
                        <div class="d-flex gap-4 align-items-center">
                            <div class="avatar-text avatar-lg bg-gray-200">
                                <a href="{{ url('employee/list')}}" target="_blank" class="">
                                    <i class="bi bi-person-badge"></i>
                                </a>
                            </div>
                            <div>
                                <div class="fs-4 fw-bold text-dark"><span class="counter">{{ $total_employee }}</span></div>
                                <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Employee</h3>
                            </div>
                        </div>
                        <a href="javascript:void(0);" class="">
                            <i class="feather-more-vertical"></i>
                        </a>
                    </div>
                    <div class="pt-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="javascript:void(0);" class="fs-12 fw-medium text-muted text-truncate-1-line">Employee Status</a>
                            <div class="w-100 text-end">
                                <span class="fs-11 text-muted">{{ $total_employee }}%</span>
                            </div>
                        </div>
                        <div class="progress mt-2 ht-3">
                            <div class="progress-bar bg-primary" role="progressbar" 
                                style="width: {{ $total_employee }}%" 
                                aria-valuenow="{{ $total_employee }}" 
                                aria-valuemin="0" 
                                aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [Invoices Awaiting Payment] end -->
       
        <!-- [Projects In Progress] start -->
        <div class="col-xxl-6 col-md-6">
            <div class="card stretch stretch-full">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between mb-4">
                        <div class="d-flex gap-4 align-items-center">
                            <div class="avatar-text avatar-lg bg-gray-200">
                                <a href="{{ url('vehicle/list')}}" target="_blank" class="">
                                    <i class="bi bi-truck"></i>
                                </a>
                            </div>
                            <div>
                                <div class="fs-4 fw-bold text-dark"><span class="counter">{{ $total_vehicle }}</span></div>
                                <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Vehicle</h3>
                            </div>
                        </div>
                        <a href="javascript:void(0);" class="">
                            <i class="feather-more-vertical"></i>
                        </a>
                    </div>
                    <div class="pt-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="javascript:void(0);" class="fs-12 fw-medium text-muted text-truncate-1-line">Vehicle Process</a>
                            <div class="w-100 text-end">
                                <span class="fs-11 text-muted">{{ $total_vehicle }}%</span>
                            </div>
                        </div>
                        <div class="progress mt-2 ht-3">
                            <div class="progress-bar bg-info" role="progressbar" 
                                style="width: {{ $total_vehicle }}%" 
                                aria-valuenow="{{ $total_vehicle }}" 
                                aria-valuemin="0" 
                            aria-valuemax="1000">
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

         <!-- [Converted Leads] start -->
        <div class="col-xxl-6 col-md-6">
            <div class="card stretch stretch-full">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between mb-4">
                        <div class="d-flex gap-4 align-items-center">
                            <div class="avatar-text avatar-lg bg-gray-200">
                                <a href="{{ url('product/list')}}" target="_blank" class="">
                                    <i class="bi bi-box-seam"></i>
                                </a>
                            </div>
                            <div>
                                <div class="fs-4 fw-bold text-dark"><span class="counter">{{ $active_vehicle }}</span></div>
                                <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Active Vehicle</h3>
                            </div>
                        </div>
                        <a href="javascript:void(0);" class="">
                            <i class="feather-more-vertical"></i>
                        </a>
                    </div>
                    <div class="pt-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="javascript:void(0);" class="fs-12 fw-medium text-muted text-truncate-1-line">Chassis No Process</a>
                            <div class="w-100 text-end">
                                <span class="fs-11 text-muted">{{ $active_vehicle }}%</span>
                            </div>
                        </div>
                        <div class="progress mt-2 ht-3">
                            <div class="progress-bar bg-warning" role="progressbar" 
                                style="width: {{ $active_vehicle }}%" 
                                aria-valuenow="{{ $active_vehicle }}" 
                                aria-valuemin="0" 
                                aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [Converted Leads] end -->
        <!-- [Projects In Progress] end -->
        <!-- [Conversion Rate] start -->
        <div class="col-xxl-6 col-md-6">
            <div class="card stretch stretch-full">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between mb-4">
                        <div class="d-flex gap-4 align-items-center">
                            <div class="avatar-text avatar-lg bg-gray-200">
                                <a href="{{ url('transfer-vehicle/list')}}" target="_blank" class="">
                                    <i class="fas fa-box"></i>
                                </a>
                            </div>
                            <div>
                                <div class="fs-4 fw-bold text-dark"><span class="counter">{{ $total_transfered}}</span></div>
                                <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Transferred</h3>
                            </div>
                        </div>
                        <a href="javascript:void(0);" class="">
                            <i class="feather-more-vertical"></i>
                        </a>
                    </div>
                    <div class="pt-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="javascript:void(0);" class="fs-12 fw-medium text-muted text-truncate-1-line">Vehicle Transferd Process</a>
                            <div class="w-100 text-end">
                                <span class="fs-11 text-muted">{{ $total_transfered }}%</span>
                            </div>
                        </div>
                        <div class="progress mt-2 ht-3">
                            <div class="progress-bar bg-danger" role="progressbar" 
                                style="width: {{ $total_transfered }}%" 
                                aria-valuenow="{{ $total_transfered }}" 
                                aria-valuemin="0" 
                            aria-valuemax="1000">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    <!-- [Payment Records] start -->
    <div class="row">
       <div class="col-xxl-12">
            <div class="card stretch stretch-full">
                <div class="card-header">
                    <h5 class="card-title">Month vs Total Active Vehicle</h5>
                    <div class="card-header-action">
                        <!-- <div class="card-header-btn">
                            <div data-bs-toggle="tooltip" title="Delete">
                                <a href="javascript:void(0);" class="avatar-text avatar-xs bg-danger" data-bs-toggle="remove"> </a>
                            </div>
                            <div data-bs-toggle="tooltip" title="Refresh">
                                <a href="javascript:void(0);" class="avatar-text avatar-xs bg-warning" data-bs-toggle="refresh"> </a>
                            </div>
                            <div data-bs-toggle="tooltip" title="Maximize/Minimize">
                                <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success" data-bs-toggle="expand"> </a>
                            </div>
                        </div> -->
                        <!-- <div class="dropdown">
                            <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="dropdown" data-bs-offset="25, 25">
                                <div data-bs-toggle="tooltip" title="Options">
                                    <i class="feather-more-vertical"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:void(0);" class="dropdown-item"><i class="feather-at-sign"></i>New</a>
                                <a href="javascript:void(0);" class="dropdown-item"><i class="feather-calendar"></i>Event</a>
                                <a href="javascript:void(0);" class="dropdown-item"><i class="feather-bell"></i>Snoozed</a>
                                <a href="javascript:void(0);" class="dropdown-item"><i class="feather-trash-2"></i>Deleted</a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0);" class="dropdown-item"><i class="feather-settings"></i>Settings</a>
                                <a href="javascript:void(0);" class="dropdown-item"><i class="feather-life-buoy"></i>Tips & Tricks</a>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="card-body custom-card-action p-0">
                    <div id="payment-records-chart"></div>
                </div>
                <div class="card-footer">
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <div class="p-3 border border-dashed rounded">
                                <div class="fs-12 text-muted mb-1">Awaiting</div>
                                <h6 class="fw-bold text-dark">$5,486</h6>
                                <div class="progress mt-2 ht-3">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 81%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="p-3 border border-dashed rounded">
                                <div class="fs-12 text-muted mb-1">Completed</div>
                                <h6 class="fw-bold text-dark">$9,275</h6>
                                <div class="progress mt-2 ht-3">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 82%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="p-3 border border-dashed rounded">
                                <div class="fs-12 text-muted mb-1">Rejected</div>
                                <h6 class="fw-bold text-dark">$3,868</h6>
                                <div class="progress mt-2 ht-3">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 68%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="p-3 border border-dashed rounded">
                                <div class="fs-12 text-muted mb-1">Revenue</div>
                                <h6 class="fw-bold text-dark">$50,668</h6>
                                <div class="progress mt-2 ht-3">
                                    <div class="progress-bar bg-dark" role="progressbar" style="width: 75%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [Payment Records] end -->
    </div>
</div>
        <!-- [ page-header ] end -->
        <!-- [ Main Content ] start -->
        <!-- dashboardMainContent -->
        <!-- [ Main Content ] end -->
</div>
    <!-- [ Footer ] start -->
    <!-- @include('backend.footer') -->
    <!-- [ Footer ] end -->
</main>
 
<script type="text/javascript">
    document.getElementById('vehicle_id').addEventListener('change', function() {
        document.getElementById('submitForm').submit();
    });
</script>


@endsection
