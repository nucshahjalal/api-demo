@extends('backend.app')
@section('page_title','API')
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
                <div class="dropdown filter-dropdown">
                    <div class="page-header-right ms-auto">
                        <form method="get" action="{{ url('/dashboard') }}" id="submitForm" class="d-flex align-items-center gap-2">
                            @csrf
                            <label class="form-label" style="white-space: nowrap;"> From Date</label>
                            <input type="text" name="from_date" id="add_from_date" class="form-control form-control-sm" style="max-width: 160px;" value="{{ request('from_date') }}" placeholder="From Date">
                            <label class="form-label" style="white-space: nowrap;">To Date </label>
                            <input type="text" name="to_date" id="add_to_date" class="form-control form-control-sm" style="max-width: 160px;" value="{{ request('to_date') }}" placeholder="To Date">
                            <div class="col-auto">
                                <button class="btn btn-sm btn-primary"><i class="bi bi-search"></i> Search</button>
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
       
        
    </div>
</div> 
    <!-- [Graph chart] start -->
   
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
 
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Date calender -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<script type="text/javascript">

    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#add_from_date", {
            dateFormat: "Y-m-d", 
            altInput: true,
            altFormat: "F j, Y",
        });
        flatpickr("#add_to_date", {
            dateFormat: "Y-m-d", 
            altInput: true,
            altFormat: "F j, Y",
        });
    });

</script>



@endsection
