@extends('backend.app')
@section('page_title','Employee List')
@section('content')

<main class="nxl-container">
<div class="nxl-content">
        <!-- [ page-header ] start -->
    <div class="page-header d-flex align-items-center justify-content-between">
    <div class="page-header-left d-flex align-items-center gap-2">
        <a href="{{ url('employee/list') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-list"></i> List
        </a>
        <a href="{{ url('employee/create') }}" class="btn btn-sm btn-success">
            <i class="bi bi-plus"></i> Add
        </a>
    </div>

    <div class="page-header-right ms-auto">
        <form method="get" action="{{ url('employee/list') }}">
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
                                            <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Emp ID</th>
                                            <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Name</th>
                                            <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Designation</th>
                                            <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Phone</th>
                                            <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Status</th>
                                            <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                          @forelse ($employees as $obj)
                                        <tr>
                                            <td>{{ $loop->index + $employees->firstItem() }}</td>
                                            <td>{{ $obj->emp_id }}</td>
                                            <td>{{ $obj->name }}</td>
                                            <td>{{ $obj->designation }}</td>
                                            <td>{{ $obj->phone }}</td>
                                            <td>{{ $obj->status ? 'Active' : 'InActive' }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-primary" href="{{ url('employee/view', $obj->id) }}"> <i class="bi bi-eye"></i> View</a>
                                                <a class="btn btn-sm btn-info" href="{{ url('employee/edit', $obj->id) }}"><i class="bi bi-pencil-square"></i> Edit</a>
                                                <a class="btn btn-sm btn-danger" href="{{ url('employee/delete', $obj->id) }}"><i class="bi bi-trash"></i> Delete</a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">There are no data found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                             {!! $employees->withQueryString()->links('pagination::bootstrap-5') !!}
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