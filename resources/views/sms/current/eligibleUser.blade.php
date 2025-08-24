@extends('backend.app')
@section('page_title','Eligible User')
@section('content')

<main class="nxl-container">
<div class="nxl-content">
        <!-- [ page-header ] start -->
    <div class="page-header d-flex align-items-center justify-content-between">
    <div class="page-header-left d-flex align-items-center gap-2">
        <a href="{{ url('vehicle/eligible-user/export') }}" class="btn btn-sm btn-info">
            <i class="bi bi-file-earmark-excel"></i> Export Excel
        </a>

        <a href="{{ url('vehicle/eligible-user/download-pdf') }}" class="btn btn-sm btn-dark">
            <i class="bi bi-file-earmark-pdf"></i> Download PDF
        </a>
    </div>

    <div class="page-header-left d-flex align-items-center gap-2">
        <div class="page-header-right ms-auto">
            <form method="get" action="{{ url('vehicle/eligible-user/list') }}">
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
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Is Loan</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Registration Date</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Registration Duration</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Motor Cycle Status</th>
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
                                <td>{!! $obj->is_loan == 0 ? '<span style="color:red;">Loan</span>' : '<span style="color:green;">Cash</span>' !!}</td>
                                <td>{{ $obj->reg_date }}</td>
                                <td>{{ $obj->total_reg_duration }}</td>
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

