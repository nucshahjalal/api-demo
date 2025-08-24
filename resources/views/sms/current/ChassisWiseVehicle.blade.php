@extends('backend.app')
@section('page_title','Chassis Wise Vehicle List')
@section('content')

<main class="nxl-container">
<div class="nxl-content">
        <!-- [ page-header ] start -->
    <div class="page-header d-flex align-items-center justify-content-between">
    <div class="page-header-left d-flex align-items-center gap-2">
        <a href="#" id="download_excel" class="btn btn-sm btn-info">
            <i class="bi bi-file-earmark-excel"></i> Export Excel
        </a>

        <a href="#"id="download_pdf" class="btn btn-sm btn-dark">
            <i class="bi bi-file-earmark-pdf"></i> Download PDF
        </a>
    </div>

    <div class="page-header-right ms-auto">
        <form method="get" action="{{ url('chassis-wise-vehicle/list') }}" id="empForm">
            @csrf
            <div class="d-flex align-items-center gap-2">
                <select style="font-size:16px;"  class="form-control form-control-lg" name="product_id" id="product_id" data-select2-selector="icon">
                    <option  style="font-size:15px;" value="">&#128269; -- Select --</option> 
                    @foreach($products as $obj) 
                        <option style="font-size:15px;" value="{{ $obj->id }}"  {{ request('product_id') == $obj->id ? 'selected' : '' }}>{{ $obj->model . '(' . $obj->chassis_no .')' }}</option>
                    @endforeach 
                </select>
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
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Model Name</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Brand Name</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Engine No</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Chassis No</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Registration No</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Portfolio</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Location</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Receive Date</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Usage Duration</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">is loan?</th>
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
                                <td>{!! $obj->is_loan == '0' ? '<span style="color:red;">Loan</span>' : '<span style="color:green;">Cash</span>' !!}</td>
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
    document.getElementById('product_id').addEventListener('change', function() {
        document.getElementById('empForm').submit();
    });
</script>

<script type="text/javascript">
    document.getElementById('download_pdf').addEventListener('click', function(e) {
        e.preventDefault();
        var productId = document.getElementById('product_id').value;
        window.location.href = "{{ url('chassis-wise-vehicle/download-pdf') }}" + "?product_id=" + productId;
    });

    document.getElementById('download_excel').addEventListener('click', function(e) {
        e.preventDefault();
        var productId = document.getElementById('product_id').value;
        window.location.href = "{{ url('chassis-wise-vehicle/export') }}" + "?product_id=" + productId;
    });
</script>

@endsection
