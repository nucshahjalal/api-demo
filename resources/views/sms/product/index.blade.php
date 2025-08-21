@extends('backend.app')
@section('page_title','Product List')
@section('content')

<main class="nxl-container">
<div class="nxl-content">
        <!-- [ page-header ] start -->
    <div class="page-header d-flex align-items-center justify-content-between">
    <div class="page-header-left d-flex align-items-center gap-2">
    </div>

    <div class="page-header-left d-flex align-items-center gap-2">
        <div class="page-header-right ms-auto">
            <form method="get" action="{{ url('product/list') }}">
                @csrf
                <div class="d-flex align-items-center gap-2">
                    <input class="form-control" type="text" name="filter" 
                        value="{{ request('filter') }}" id="filter" placeholder="Search...">
                    <div class="col-auto">
                        <button class="btn btn-sm btn-primary"><i class="bi bi-search"></i> Search</button>
                    </div>
                </div>
            </form>
        </div>
        <a href="{{ url('product/create') }}" class="btn btn-sm  btn-success">
            <i class="feather-plus me-2"></i>
            <span>Add New</span>
        </a>
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
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Engine No</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Chassis No</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Brand</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Model</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Registration Date</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Registration Number</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Status</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($products as $obj)
                            <tr>
                                <td>{{ $loop->index + $products->firstItem() }}</td>
                                <td>{{ $obj->eng_no }}</td>
                                <td>{{ $obj->chassis_no }}</td>
                                <td>{{ $obj->brand }}</td>
                                <td>{{ $obj->model }}</td>
                                <td>{{ $obj->registration_date }}</td>
                                <td>{{ $obj->registration_number }}</td>
                                <td>{{ $obj->status ? 'Active' : 'InActive' }}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{ url('product/view', $obj->id) }}"> <i class="bi bi-eye"></i> View</a>
                                    <a class="btn btn-sm btn-info" href="{{ url('product/edit', $obj->id) }}"><i class="bi bi-pencil-square"></i> Edit</a>
                                    <a class="btn btn-sm btn-danger" href="{{ url('product/delete', $obj->id) }}" onclick="javascript: return confirm('are you sure delete?')"><i class="bi bi-trash"></i> Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">There are no data found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                    {!! $products->withQueryString()->links('pagination::bootstrap-5') !!}
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