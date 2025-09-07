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
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
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
                    <div id="reportrange" class="reportrange-picker d-flex align-items-center">
                        <span class="reportrange-picker-field"></span>
                    </div>
                    <div class="dropdown filter-dropdown">
                        <a class="btn btn-md btn-light-brand" data-bs-toggle="dropdown" data-bs-offset="0, 10" data-bs-auto-close="outside">
                            <i class="feather-filter me-2"></i>
                            <span>Filter</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="dropdown-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="Role" checked="checked" />
                                    <label class="custom-control-label c-pointer" for="Role">Role</label>
                                </div>
                            </div>
                            <div class="dropdown-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="Team" checked="checked" />
                                    <label class="custom-control-label c-pointer" for="Team">Team</label>
                                </div>
                            </div>
                            <div class="dropdown-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="Email" checked="checked" />
                                    <label class="custom-control-label c-pointer" for="Email">Email</label>
                                </div>
                            </div>
                            <div class="dropdown-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="Member" checked="checked" />
                                    <label class="custom-control-label c-pointer" for="Member">Member</label>
                                </div>
                            </div>
                            <div class="dropdown-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="Recommendation" checked="checked" />
                                    <label class="custom-control-label c-pointer" for="Recommendation">Recommendation</label>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="feather-plus me-3"></i>
                                <span>Create New</span>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="feather-filter me-3"></i>
                                <span>Manage Filter</span>
                            </a>
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
                                <div class="fs-4 fw-bold text-dark"><span class="counter">{{ $total_chesis_no }}</span></div>
                                <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Chassis No</h3>
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
                                <span class="fs-11 text-muted">{{ $total_chesis_no }}%</span>
                            </div>
                        </div>
                        <div class="progress mt-2 ht-3">
                            <div class="progress-bar bg-warning" role="progressbar" 
                                style="width: {{ $total_chesis_no }}%" 
                                aria-valuenow="{{ $total_chesis_no }}" 
                                aria-valuemin="0" 
                                aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [Converted Leads] end -->
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
                                <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Transfered</h3>
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
 
@endsection
