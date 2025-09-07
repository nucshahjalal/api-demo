<!DOCTYPE html>
<html>
<head>
    <title>PDF Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; text-align: center; }
        th { background: #f2f2f2; }
        h2 { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h2>Assign Vehicle List</h2>
    <table >
        <thead>
            <tr>
                <th>SL No</th>
                <th>Employee Name</th>
                <th>Model Name</th>
                <th>Brand Name</th>
                <th>Engine No</th>
                <th>Chassis No</th>
                <th>Registration No</th>
                <th>Portfolio</th>
                <th>Location</th>
                <th>Receive Date</th>
                <th>Usage Duration</th>
                <th>Is Loan</th>
                <th>Registration Date</th>
                <th>Registration Duration</th>
                <th>Motor Cycle Status</th>
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
                <td colspan="13">There are no data found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
