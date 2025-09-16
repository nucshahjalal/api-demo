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
                                                <span class="fw-bold text-primary">#{{$employee->emp_id}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <!-- Vehicle Table -->
                            <hr class="border-dashed mb-0">
                            <div class="table-responsive">
                                @forelse($vehicles as $obj)
                                    <div style="margin-bottom: 1rem; padding: 10px; border: 1px solid #ccc;">
                                        <p><strong>SL No:</strong> {{ $loop->index + $vehicles->firstItem() }}</p>
                                        <p><strong>Model Name:</strong> {{ $obj->model_name }}</p>
                                        <p><strong>Brand Name:</strong> {{ $obj->brand_name }}</p>
                                        <p><strong>Engine No:</strong> {{ $obj->eng_no }}</p>
                                        <p><strong>Chassis No:</strong> {{ $obj->chassis_no }}</p>
                                        <p><strong>Registration No:</strong> {{ $obj->registration_number }}</p>
                                        <p><strong>Portfolio:</strong> {{ $obj->portfolio_name }}</p>
                                        <p><strong>Location:</strong> {{ $obj->location }}</p>
                                        <p><strong>Receive Date:</strong> {{ date('m-d-Y', strtotime($obj->receive_date)) }}</p>
                                        <p><strong>Usage Duration:</strong> {{ $obj->total_receive_duration }}</p>
                                        <p><strong>Is Loan?:</strong> 
                                            {!! $obj->is_loan == 0 
                                                ? '<span style="color:red;">Loan</span>' 
                                                : '<span style="color:green;">Cash</span>' !!}
                                        </p>
                                        <p><strong>Registration Date:</strong> {{ $obj->reg_date }}</p>
                                        <p><strong>Registration Duration:</strong> {{ $obj->total_reg_duration }}</p>
                                        <p><strong>Motor Cycle Status:</strong> {{ $obj->mc_status }}</p>
                                        <p><strong>Transfer Date:</strong> {{ date('m-d-Y', strtotime($obj->transfer_at)) }}</p>
                                    </div>
                                @empty
                                    <p>There are no data found.</p>
                                @endforelse
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
        .page-header-right, .printBTN {
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
</script>  -->

@endsection
