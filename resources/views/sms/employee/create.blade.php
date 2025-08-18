@extends('backend.app')
@section('page_title','Create Employee')
@section('content')

<main class="nxl-container">
    <div class="nxl-content">
        <!-- [ page-header ] start -->
       <div class="page-header">
            <div class="page-header-left d-flex align-items-center">                    
                <ul class="breadcrumb">
                        <h3 style="text-align: center !important;"> Manage Employee Information</h3>
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
                        <a href="{{ url('employee/list') }}" class="btn btn-sm btn-lg btn-primary w-100 text-white fw-bold" >
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
                        <form action="{{ url('employee/save') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Employee ID <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="emp_id"  value="{{ old('emp_id') }}" id="emp_id" placeholder="Employee ID">
                                </div>
                                @error('emp_id')
                                    <div style="color: red">{{ $message }}</div>
                                @enderror 
                            </div>
                    
                            <div class="row">     
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label"> Name </label>
                                    <input class="form-control" type="text" name="name"  value="{{ old('name') }}" id="name" placeholder="Name">
                                </div>
                                    @error('name')
                                    <div style="color: red">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">      
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Designation </label>
                                    <input class="form-control" type="text" name="designation"  value="{{ old('designation') }}" id="designation" placeholder="Designation">
                                </div>
                                @error('designation')
                                    <div style="color: red">{{ $message }}</div>
                                @enderror 
                            </div>

                            <div class="row">     
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Phone </label>
                                    <input class="form-control" type="number" name="phone"  value="{{ old('phone') }}" id="phone" placeholder="Phone">
                                </div>
                                @error('phone')
                                    <div style="color: red">{{ $message }}</div>
                                @enderror      
                            </div>
                            
                            <button type="submit" class="btn btn-sm btn-success"> Submit</button>
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

@endsection