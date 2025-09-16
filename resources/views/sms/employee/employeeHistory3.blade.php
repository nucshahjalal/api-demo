@extends('backend.app')

@section('page_title', 'Vehicle List')

@section('content')
<main class="nxl-container">
    <div class="nxl-content">

        <!-- Page Header -->
        <div class="page-header d-flex align-items-center justify-content-between">
            <div class="page-header-left d-flex align-items-center gap-2">
                <!-- <a id="download_pdf" href="#" class="btn btn-sm btn-dark">
                    <i class="bi bi-file-earmark-pdf"></i> Download PDF
                </a> -->

                <!-- <a href="javascript:void(0)" class="d-flex me-1 printBTN">
                    <div class="avatar-text avatar-md" data-bs-toggle="tooltip" title="Print Invoice">
                        <i class="feather feather-printer"></i>
                    </div>
                </a> -->
                <button class="btn btn-sm btn-info printBTN"><i class="feather feather-printer"></i> Print</button>
            </div>

            <div class="page-header-left d-flex align-items-center gap-2">
                <a href="{{ url('employee/list') }}" class="btn btn-sm btn-lg btn-primary w-100 text-white fw-bold">
                    ← Back
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="row">
                <div class="col-xl-12" id="printableArea">
                    <div class="card invoice-container">
                        <div class="card-body p-0" >
                           <div class="px-4 pt-4">
                                    <div class="d-sm-flex align-items-center justify-content-between">
                                        <div>
                                            <div class="fs-4 fw-bold text-primary">Employee History</div>
                                            <address class="text-muted">
                                                Name: {{$employee->name}}<br>
                                                Designation: {{$employee->designation}}<br>
                                                Phone: {{$employee->phone}}
                                            </address>
                                        </div>
                                        <div class="lh-lg pt-3 pt-sm-0">
                                            <h2 class="fs-4 fw-bold text-primary">Invoice</h2>
                                            <div>
                                                <span class="fw-bold text-dark">Invoice No:</span>
                                                <span class="fw-bold text-primary">{{$employee->emp_id}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <!-- Vehicle Table -->
                            <hr class="border-dashed mb-0">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">SL No</th>
                                            <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Model Name</th>
                                            <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Brand Name</th>
                                            <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Engine No</th>
                                            <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Chassis No</th>
                                            <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Registration No</th>
                                            <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Portfolio</th>
                                            <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Location</th>
                                            <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Receive Date</th>
                                            <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Usage Duration</th>
                                            <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Is Loan?</th>
                                            <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Registration Date</th>
                                            <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Registration Duration</th>
                                            <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Motor Cycle Status</th>
                                            <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Transfer Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($vehicles as $obj)
                                            <tr>
                                                <td>{{ $loop->index + $vehicles->firstItem() }}</td>
                                                <td>{{ $obj->model_name }}</td>
                                                <td>{{ $obj->brand_name }}</td>
                                                <td>{{ $obj->eng_no }}</td>
                                                <td>{{ $obj->chassis_no }}</td>
                                                <td>{{ $obj->registration_number }}</td>
                                                <td>{{ $obj->portfolio_name }}</td>
                                                <td>{{ $obj->location }}</td>
                                                <td>{{ date('m-d-Y', strtotime($obj->receive_date)) }}</td>
                                                <td>{{ $obj->total_receive_duration }}</td>
                                                <td>
                                                    {!! $obj->is_loan == 0 
                                                        ? '<span style="color:red;">Loan</span>' 
                                                        : '<span style="color:green;">Cash</span>' !!}
                                                </td>
                                                <td>{{ $obj->reg_date }}</td>
                                                <td>{{ $obj->total_reg_duration }}</td>
                                                <td>{{ $obj->mc_status }}</td>
                                                <td>{{ date('m-d-Y', strtotime($obj->transfer_at)) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="15" class="text-center">There are no data found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<!-- Style -->
<style>
    .btn {
        text-transform: capitalize;
    }

    @media print {
        .page-header-center, .printBTN, #download_pdf {
            display: none !important;
        }
    }
</style>

<script type="text/javascript">
    document.querySelector('.printBTN').addEventListener('click', function () {
        var printContents = document.getElementById('printableArea').innerHTML;
        var printWindow = window.open('', '', 'height=800,width=1200');

        printWindow.document.write('<html><head><title>Employee History</title>');
        printWindow.document.write('<style>');
        printWindow.document.write(`
            body { font-family: Arial, sans-serif; padding: 20px; }
            table { border-collapse: collapse; width: 100%; }
            table, th, td { border: 1px solid #ddd; padding: 8px; }
            th { background-color: #f2f2f2; text-align: left; }
            h2 { margin-top: 0; }
        `);
        printWindow.document.write('</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write(printContents);
        printWindow.document.write('</body></html>');

        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    });
</script>

<!-- Script: PDF Download -->
<!-- <script type="text/javascript">
    document.getElementById('download_pdf').addEventListener('click', function(e) {
        e.preventDefault();
        const empId = document.getElementById('emp_id').value;
        const downloadUrl = "{{ url('vehicle/employee-history/download-pdf') }}/" + empId;
        window.location.href = downloadUrl;
    });
</script> -->

@endsection
