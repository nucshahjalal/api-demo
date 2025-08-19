@extends('backend.app')
@section('page_title','Employee View')
@section('content')

<main class="nxl-container">
    <div class="nxl-content">
        <!-- [ page-header ] start -->
       <div class="page-header">
            <div class="page-header-left d-flex align-items-center">                    
                <ul class="breadcrumb">
                        <h3 style="text-align: center !important;"> Manage Employee View</h3>
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
                        <a href="{{ url('employee/list') }}" class="btn btn-sm  btn-primary w-100 text-white fw-bold" style="font-size: 20px;">
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
                        <form action="{{ route('employee.update') }}" method="POST">
                            @csrf

                            <input class="form-control" type="hidden" name="id" value="{{ $employee->id }}"  id="id" >
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Employee ID <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="emp_id"  value="{{ $employee->emp_id }}" id="emp_id" placeholder="Employee ID" readonly>
                                </div> 
                            </div>
                            <div class="row">     
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label"> Name </label>
                                    <input class="form-control" type="text" name="name"  value="{{$employee->name }}" id="name" placeholder="Name" readonly>
                                </div>
                            </div>
                            <div class="row">      
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Designation </label>
                                    <input class="form-control" type="text" name="designation"  value="{{ $employee->designation }}" id="designation" placeholder="Designation" readonly>
                                </div> 
                            </div>
                            <div class="row">     
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Phone </label>
                                    <input class="form-control" type="number" name="phone"  value="{{ $employee->phone }}" id="phone" placeholder="Phone" readonly>
                                </div>      
                            </div>
                            <div class="row">     
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Portfolio </label>
                                    <input class="form-control" type="text" name="portfolio"  value="{{ $employee->portfolio }}" id="portfolio" placeholder="Portfolio" readonly>
                                </div>      
                            </div>
                            <div class="row">     
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Status </label>
                                    <select class="form-control" name="status" id="status" data-select2-selector="icon" readonly>
                                        <option value="1" {{ ($employee->status ?? '') == '1' ? 'selected' : '' }} data-icon="feather-at-sign">Active</option>
                                        <option value="0" {{ ($employee->status ?? '') == '0' ? 'selected' : '' }} data-icon="feather-at-sign">In Active</option> 
                                    </select>
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

@endsection