@extends('backend.app')
@section('page_title','Edit Product')
@section('content')

<main class="nxl-container">
    <div class="nxl-content">
        <!-- [ page-header ] start -->
       <div class="page-header">
            <div class="page-header-left d-flex align-items-center">                    
                <ul class="breadcrumb">
                        <h3 style="text-align: center !important;"> Manage Product Information</h3>
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
                        <a href="{{ url('product/list') }}" class="btn btn-sm btn-primary w-100 text-white fw-bold">
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
                        <form action="{{ route('product.update') }}" method="POST">
                            @csrf

                        <input class="form-control" type="hidden" name="id" value="{{ $product->id }}"  id="id" >
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Engine No <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="eng_no"  value="{{  $product->eng_no }}" id="eng_no" placeholder="Engine No">
                            </div>
                            @error('eng_no')
                                <div style="color: red">{{ $message }}</div>
                            @enderror 
                        </div>
                
                        <div class="row">     
                            <div class="col-lg-6 mb-3">
                                <label class="form-label"> Chassis No <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="chassis_no"  value="{{  $product->chassis_no }}" id="chassis_no" placeholder="Chassis No">
                            </div>
                                @error('chassis_no')
                                <div style="color: red">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">     
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Brand </label>
                                <select class="form-control" name="brand" id="brand" data-select2-selector="icon">
                                    <option value="0" data-icon="feather-at-sign">--Select Brand--</option>
                                    <option value="Yamaha" {{ ($product->brand ?? '') == 'Yamaha' ? 'selected' : '' }} data-icon="feather-at-sign">Yamaha</option> 
                                </select>
                            </div>
                            @error('brand')
                                <div style="color: red">{{ $message }}</div>
                            @enderror      
                        </div>

                        <div class="row">     
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Model </label>
                                <select class="form-control" name="model" id="model" data-select2-selector="icon">
                                    <option value="0" data-icon="feather-at-sign">--Select Model--</option>
                                    <option value="FZS-V2 150 CC" {{ ($product->model ?? '') == 'FZS-V2 150 CC' ? 'selected' : '' }} data-icon="feather-at-sign">FZS-V2 150 CC</option> 
                                    <option value="MT 15- 150 CC" {{ ($product->model ?? '') == 'MT 15- 150 CC' ? 'selected' : '' }} data-icon="feather-at-sign">MT 15- 150 CC</option> 
                                    <option value="FZS-V3 150 CC" {{ ($product->model ?? '') == 'FZS-V3 150 CC' ? 'selected' : '' }} data-icon="feather-at-sign">FZS-V3 150 CC</option> 
                                    <option value="Saluto 125 CC" {{ ($product->model ?? '') == 'Saluto 125 CC' ? 'selected' : '' }} data-icon="feather-at-sign">Saluto 125 CC</option> 
                                </select>
                            </div>
                            @error('model')
                                <div style="color: red">{{ $message }}</div>
                            @enderror      
                        </div>

                        <div class="row">     
                            <div class="col-lg-6 mb-3">
                                <label class="form-label"> Registration Date</label>
                                <input class="form-control" type="text" name="registration_date"  value="{{ $product->registration_date }}" id="edit_registration_date" placeholder="Registration Date">
                            </div>
                                @error('registration_date')
                                <div style="color: red">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">     
                            <div class="col-lg-6 mb-3">
                                <label class="form-label"> Registration Number <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="registration_number"  value="{{ $product->registration_number }}" id="registration_number" placeholder="Registration Number">
                            </div>
                                @error('registration_number')
                                <div style="color: red">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">     
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Status </label>
                                <select class="form-control" name="status" id="status" data-select2-selector="icon">
                                    <option value="1" {{ ($product->status ?? '') == '1' ? 'selected' : '' }} data-icon="feather-at-sign">Active</option>
                                    <option value="0" {{ ($product->status ?? '') == '0' ? 'selected' : '' }} data-icon="feather-at-sign">In Active</option> 
                                </select>
                            </div>
                            @error('status')
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
        flatpickr("#edit_registration_date", {
            dateFormat: "Y-m-d", 
            altInput: true,
            altFormat: "F j, Y",
        });
    });
    
</script>

@endsection