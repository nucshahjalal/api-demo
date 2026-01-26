@extends('backend.app')
@section('page_title','Edit Portfolio')
@section('content')

<main class="nxl-container">
    <div class="nxl-content">
        <!-- [ page-header ] start -->
       <div class="page-header">
            <div class="page-header-left d-flex align-items-center">                    
                <ul class="breadcrumb">
                        <h3 style="text-align: center !important;"> Manage Portfolio Information</h3>
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
                        <a href="{{ url('portfolio/list') }}" class="btn btn-sm btn-primary w-100 text-white fw-bold">
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
                        <form action="{{ route('portfolio.update') }}" method="POST">
                            @csrf

                            <input class="form-control" type="hidden" name="id" value="{{ $portfolio->id }}"  id="id" >
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name"  value="{{ $portfolio->name }}" id="name" placeholder="Name">
                                </div> 
                                @error('name')
                                    <div style="color: red">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">     
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Status </label>
                                    <select class="form-control" name="status" id="status" data-select2-selector="icon">
                                        <option value="1" {{ ($portfolio->status ?? '') == '1' ? 'selected' : '' }} data-icon="feather-at-sign">Active</option>
                                        <option value="0" {{ ($portfolio->status ?? '') == '0' ? 'selected' : '' }} data-icon="feather-at-sign">In Active</option> 
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

@endsection
