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
                <button class="btn btn-sm btn-info printBTN"><i class="feather feather-printer"></i> Print</button>
            </div>

            <div class="page-header-left d-flex align-items-center gap-2">
                <a href="{{ url('employee/list') }}" class="btn btn-sm btn-lg btn-primary w-100 text-white fw-bold">
                    ← Back
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content p-4">
            <div class="row">
                <div class="col-xl-12" id="printableArea">
                    <div class="card invoice-container">
                        <div class="card-body p-0" >
                            <div class="px-4 pt-4">
                                <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center;" class="d-sm-flex">
                                    
                                    <div>
                                        <address class="text-muted" style="margin-left: 0px; font-style: normal;">
                                            <span class="fs-4 fw-bold text-primary">Employee History: {{ ucfirst($employee->name) }}</span><br>
                                            Designation: {{$employee->designation}}<br>
                                            Phone: {{$employee->phone}}
                                        </address>
                                    </div>
                                    
                                    <div class="text-center">
                                       <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('backend/assets/images/logo.jpg'))) }}" style="height: 80px;">
                                    </div>

                                    <div class="lh-lg pt-3 pt-sm-0 text-end" style="margin-right: 10px;">
                                        <h2 class="fs-4 fw-bold text-primary"></h2>
                                        <div>
                                            <span class="fw-bold text-dark">Report No:</span>
                                            <span class="fw-bold text-primary">#{{$employee->emp_id}}</span>
                                        </div>
                                        <div>
                                            <span class="fw-bold text-dark">Date:</span>
                                            <span class="fw-bold text-primary">{{ date('d-m-Y', strtotime(now())) }}</span>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <!-- Vehicle Table -->
                             <br>
                            <!-- <hr class="border-dashed mb-0"> -->
                            <div class="table-responsive">
                                @php
                                 $hasOngoing = $vehicles->contains(function($v) {
                                    return empty($v->transfer_at); 
                                });
                                $ongoingIndex = 1;
                                $transferredIndex = $hasOngoing ? 2 : 1; 
                                    
                                @endphp
                                @forelse($vehicles as $obj)
                                    <div style="margin-bottom: 1rem; padding: 10px; border: 1px solid #ccc;"> 
                                        <div style="display: flex; flex-wrap: wrap; gap: 10px; width:58rem;pading:10px;"> 
                                            
                                            <div style="flex: 1 1 100%;">
                                                <strong>
                                                    @if (empty($obj->transfer_at))
                                                        {{ $ongoingIndex++ . '. Ongoing' }}
                                                    @else
                                                        {{ $transferredIndex++ . '. Transferred Date:' }}
                                                    @endif
                                                </strong>
                                                {{ !empty($obj->transfer_at) ? date('d-m-Y', strtotime($obj->transfer_at)) : '' }}
                                            </div>
                                            
                                            <div style="flex: 1 1 45%;"><strong>Model Name:</strong> {{ $obj->model_name }}</div> 
                                            <div style="flex: 1 1 45%;"><strong>Brand Name:</strong> {{ $obj->brand_name }}</div> 
                                            <div style="flex: 1 1 45%;"><strong>Engine No:</strong> {{ $obj->eng_no }}</div> 
                                            <div style="flex: 1 1 45%;"><strong>Chassis No:</strong> {{ $obj->chassis_no }}</div> 
                                            <div style="flex: 1 1 45%;"><strong>Registration No:</strong> {{ $obj->registration_number }}</div> 
                                            <div style="flex: 1 1 45%;"><strong>Portfolio:</strong> {{ $obj->portfolio_name }}</div> 
                                            <div style="flex: 1 1 45%;"><strong>Location:</strong> {{ $obj->location }}</div> 
                                            <div style="flex: 1 1 45%;"><strong>Receive Date:</strong> {{ date('m-d-Y', strtotime($obj->receive_date)) }}</div> 
                                            <div style="flex: 1 1 45%;"><strong>Usage Duration:</strong> {{ $obj->total_receive_duration }}</div> 
                                            <div style="flex: 1 1 45%;"><strong>Is Loan?:</strong> {!! $obj->is_loan == 0 ? '<span style="color:red;">Loan</span>' : '<span style="color:green;">Cash</span>' !!} </div> 
                                            <div style="flex: 1 1 45%;"><strong>Registration Date:</strong> {{ $obj->reg_date }}</div> 
                                            <div style="flex: 1 1 45%;"><strong>Registration Duration:</strong> {{ $obj->total_reg_duration }}</div> 
                                            <div style="flex: 1 1 45%;"><strong>Motor Cycle Status:</strong> {{ $obj->mc_status }}</div>

                                        </div> 
                                    </div> 
                                @empty 
                                    <p colspan="8" class="text-center">There are no data found.</p>
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
