@extends('backend.app')
@section('page_title','Edit Vehicle')
@section('content')

<main class="nxl-container">
    <div class="nxl-content">
        <!-- [ page-header ] start -->
       <div class="page-header">
            <div class="page-header-left d-flex align-items-center">                    
                <ul class="breadcrumb">
                        <h3 style="text-align: center !important;"> Manage Vehicle Information</h3>
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
                        <a href="{{ url('vehicle/list') }}" class="btn btn-sm btn-primary w-100 text-white fw-bold">
                            ← Back
                        </a>
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
            <div class="col-xl-12">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <form action="{{ route('vehicle.update') }}" method="POST">
                            @csrf

                        <input class="form-control" type="hidden" name="id" value="{{ $vehicle->id }}"  id="id" >
                        <div class="row">     
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Employee Name <span class="text-danger">*</span></label>
                                <select class="form-control" name="emp_id" id="emp_id" data-select2-selector="icon">
                                    <option value="">--Select--</option> 
                                    @foreach($employees as $obj) 
                                        <option value="{{ $obj->id }}" {{ $vehicle->emp_id == $obj->id  ? 'selected' : ''}}> {{ $obj->emp_id . '[' . $obj->name . ']' }} </option>
                                    @endforeach 
                                </select>
                            </div>
                            @error('emp_id')
                                <div style="color: red">{{ $message }}</div>
                            @enderror      
                        </div>

                        <div class="row">     
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Product Name <span class="text-danger">*</span></label>
                                <select class="form-control" name="product_id" id="product_id" data-select2-selector="icon">
                                    <option value="">--Select--</option> 
                                    @foreach($products as $obj) 
                                        <option value="{{ $obj->id }}" {{ $vehicle->product_id == $obj->id  ? 'selected' : ''}}> {{ $obj->id . '[' . $obj->model . ']' }} </option>
                                    @endforeach 
                                </select>
                            </div>
                            @error('product_id')
                                <div style="color: red">{{ $message }}</div>
                            @enderror      
                        </div>

                        <div class="row">     
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Portfolio </label>
                                <select class="form-control" name="portfolio" id="portfolio" data-select2-selector="icon">
                                    <option value="">--Select--</option> 
                                    @foreach($portfolios as $obj) 
                                        <option value="{{ $obj->name }}" {{ $vehicle->portfolio == $obj->name  ? 'selected' : ''}}> {{ $obj->name }} </option>
                                    @endforeach 
                                </select>
                            </div>
                            @error('portfolio')
                                <div style="color: red">{{ $message }}</div>
                            @enderror      
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Location </label>
                                <input class="form-control" type="text" name="location"  value="{{ $vehicle->location }}" id="location" placeholder="Location">
                            </div>
                            @error('location')
                                <div style="color: red">{{ $message }}</div>
                            @enderror 
                        </div>
                
                        <div class="row">     
                            <div class="col-lg-6 mb-3">
                                <label class="form-label"> Receive Date </label>
                                <input class="form-control" type="text" name="receive_date"  value="{{ $vehicle->receive_date }}" id="edit_receive_date" placeholder="Receive Date">
                            </div>
                                @error('receive_date')
                                <div style="color: red">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">     
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">MC Status </label>
                                <select class="form-control" name="mc_status" id="mc_status" data-select2-selector="icon">
                                    <option value="0" data-icon="feather-at-sign">--Select --</option>
                                    <option value="Good" data-icon="feather-at-sign">Good</option> 
                                </select>
                            </div>
                            @error('mc_status')
                                <div style="color: red">{{ $message }}</div>
                            @enderror      
                        </div>

                            <div class="row">    
                                <div class="col-lg-12 mb-7 ">
                                    <button  type="submit" class="btn btn-success">Update</button>
                                </div> 
                            </div>
                        </form>
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

<style>
   .btn {
        text-transform: capitalize;
    }
</style>

<!-- Date calender -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#edit_receive_date", {
            dateFormat: "Y-m-d", 
            altInput: true,
            altFormat: "F j, Y",
        });
    });
    
</script>

@endsection