@extends('backend.app')
@section('page_title','Vehicle List')
@section('content')

<main class="nxl-container">
<div class="nxl-content">
        <!-- [ page-header ] start -->
    <div class="page-header d-flex align-items-center justify-content-between">
    <div class="page-header-left d-flex align-items-center gap-2">
        <a href="{{ url('vehicle/export') }}" class="btn btn-sm btn-info">
            <i class="bi bi-file-earmark-excel"></i> Export Excel
        </a>

        <a href="{{ url('vehicle/download-pdf') }}" class="btn btn-sm btn-dark">
            <i class="bi bi-file-earmark-pdf"></i> Download PDF
        </a>
    </div>

    <div class="page-header-left d-flex align-items-center gap-2">
        <div class="page-header-right ms-auto">
            <form method="get" action="{{ url('vehicle/list') }}">
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

        <a href="{{ url('vehicle/create') }}" class="btn btn-sm  btn-success">
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
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Employee Name</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Model Name</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Brand Name</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Engine No</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Chassis No</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Registration No</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Portfolio</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Location</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Receive Date</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Usage Duration</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Registration Date</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Registration Duration</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Motor Cycle Status</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($vehicles as $obj)
                            <tr>
                                <td>{{ $loop->index + $vehicles->firstItem() }}</td>
                                <td>{{ $obj->emp_name }}</td>
                                <td>{{ $obj->model_name }}</td>
                                <td>{{ $obj->brand_name }}</td>
                                <td>{{ $obj->eng_no }}</td>
                                <td>{{ $obj->chassis_no }}</td>
                                <td>{{ $obj->registration_number }}</td>
                                <td>{{ $obj->portfolio_name }}</td>
                                <td>{{ $obj->location }}</td>
                                <td>{{ $obj->receive_date }}</td>
                                <td>{{ $obj->total_receive_duration }}</td>
                                <td>{{ $obj->reg_date }}</td>
                                <td>{{ $obj->total_reg_duration }}</td>
                                <td>{{ $obj->mc_status }}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{ url('vehicle/view', $obj->id) }}"> <i class="bi bi-eye"></i> View</a>
                                    <a class="btn btn-sm btn-info" href="{{ url('vehicle/edit', $obj->id) }}"><i class="bi bi-pencil-square"></i> Edit</a>
                                    <a  href="javascript:void(0);" onclick="updateStatus({{ $obj->id }})" class="btn btn-sm btn-danger"><i class="bi bi-arrow-left-right"></i> Transfer</a>
                                </td>
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

<script type="text/javascript">
    
function updateStatus(id) {
    $.ajax({
        url: "/vehicle/update-status/",
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: id
        },
        success: function (response) {
             window.location.href = "{{ url('vehicle/transfer') }}/" + id;
           // window.location.href = "{{ url('vehicle/transfer') }}";
        },
        error: function (xhr) {
            console.error(xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Failed to update vehicle status.',
            });
        }
    });
}
     
</script>

@endsection

