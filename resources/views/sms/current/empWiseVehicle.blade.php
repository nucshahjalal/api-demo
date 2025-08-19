@extends('backend.app')
@section('page_title','Employee Wise Vehicle List')
@section('content')

<main class="nxl-container">
<div class="nxl-content">
        <!-- [ page-header ] start -->
    <div class="page-header d-flex align-items-center justify-content-between">
    <div class="page-header-left d-flex align-items-center gap-2">
        <ul class="breadcrumb">
            <h3 style="text-align: center !important;"> Manage Employee Wise Vehicle Information</h3>
        </ul>
    </div>

    <div class="page-header-right ms-auto">
        <form method="get" action="{{ url('emp-wise-vehicle/list') }}">
            @csrf
            <div class="d-flex align-items-center gap-2">
                <select class="form-control" name="emp_id" id="emp_id" data-select2-selector="icon">
                    <option value="">--Select--</option> 
                    @foreach($employees as $obj) 
                        <option value="{{ $obj->id }} "> {{ 'ID='. $obj->emp_id . '[' . $obj->name . ']' }} </option>
                    @endforeach 
                </select>
                <div class="col-auto">
                    <button class="btn btn-sm btn-primary"> Submit</button>
                </div>
            </div>
        </form>
    </div>

</div>

<div class="main-content">   
    <div class="row">
        <div class="col-xl-12">
            <div class="card stretch stretch-full">
            <div class="card-body">
            <div class="card-body custom-card-action p-0">
                <div class="table-responsive">
                    <table  class="table table-hover mb-0">
                        <thead>
                            <tr class="border-b">
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col" >SL No</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Employee Name</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Brand Name</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Portfolio</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Location</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Registration Date</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Receive Date</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Total Duration</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">MC Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($vehicles as $obj)
                            <tr>
                                <td>{{ $loop->index + $vehicles->firstItem() }}</td>
                                <td>{{ $obj->emp_name }}</td>
                                <td>{{ $obj->brand_name }}</td>
                                <td>{{ $obj->portfolio }}</td>
                                <td>{{ $obj->location }}</td>
                                <td>{{ $obj->reg_date }}</td>
                                <td>{{ $obj->receive_date }}</td>
                                <td>{{ $obj->total_duration }}</td>
                                <td>{{ $obj->mc_status }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">There are no data found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                    {!! $vehicles->withQueryString()->links('pagination::bootstrap-5') !!}
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
</div>
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
