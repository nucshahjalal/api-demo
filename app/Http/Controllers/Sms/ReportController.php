<?php

namespace App\Http\Controllers\Sms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Employee,Product,Portfolio,Current};
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public $data = array();

    public function ongoingDownloadPdf(Request $request){

        $filter = $request->filter;
        $vehicles = Current::getVehicleList($filter);
        $pdf = Pdf::loadView('sms.report.ongoingPdf', compact('vehicles'))->setPaper('a4', 'landscape');
        return $pdf->download('ongoing-pdf.pdf');
    }

    public function ongoingDownloadExcel(Request $request)
    {
        $fileName = 'ongoing-vehicle.xls'; 

        $filter = $request->filter;
        $vehicles = Current::getVehicleList($filter);

        header('Content-Type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $file = fopen('php://output', 'w');

        fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
        fputcsv($file, []);
        fputcsv($file, [
            'Employee Name', 'Brand Name','Model Name','Engine No','Chassis No',
            'Registration No','Portfolio','Location','Receive Date','Usage Duration',
            'Is Loan','Registration Date','Registration Duration','Motor Cycle Status'
        ]);
        
        foreach ($vehicles as $vehicle) {
            fputcsv($file, [
                $vehicle->emp_name,
                $vehicle->brand_name,
                $vehicle->model_name,
                $vehicle->eng_no,
                $vehicle->chassis_no,
                $vehicle->registration_number,
                $vehicle->portfolio_name,
                $vehicle->location,
                $vehicle->receive_date,
                $vehicle->total_receive_duration,
                $vehicle->is_loan == 0 ? 'Loan' : 'Cash',
                $vehicle->reg_date,
                $vehicle->total_reg_duration,
                $vehicle->mc_status,
            ]);
        }

        fclose($file);
        exit;
    }

    public function transferDownloadPdf(Request $request){

        $filter = $request->filter;
        $vehicles = Current::getTransferList($filter);
        $pdf = Pdf::loadView('sms.report.transferPdf', compact('vehicles'))->setPaper('a4', 'landscape');
        return $pdf->download('transfer-pdf.pdf');
    }

    public function transferdDownloadExcel(Request $request)
    {
        $fileName = 'transfer-vehicle.xls';

        $filter = $request->filter;
        $vehicles = Current::getTransferList($filter);

        header('Content-Type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $file = fopen('php://output', 'w');
        
        fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
        fputcsv($file, []);
        fputcsv($file, [
            'Employee Name', 'Brand Name','Model Name','Engine No','Chassis No',
            'Registration No','Portfolio','Location','Receive Date','Usage Duration',
            'Is Loan','Registration Date','Registration Duration','Motor Cycle Status','Transfer Date'
        ]);
        
        foreach ($vehicles as $vehicle) {
            fputcsv($file, [
                $vehicle->emp_name,
                $vehicle->brand_name,
                $vehicle->model_name,
                $vehicle->eng_no,
                $vehicle->chassis_no,
                $vehicle->registration_number,
                $vehicle->portfolio_name,
                $vehicle->location,
                $vehicle->receive_date,
                $vehicle->total_receive_duration,
                $vehicle->is_loan == 0 ? 'Loan' : 'Cash',
                $vehicle->reg_date,
                $vehicle->total_reg_duration,
                $vehicle->transfer_at,
            ]);
        }

        fclose($file);
        exit;
    }

    public function empWiseDownloadPdf(Request $request)
    {
        $empName = $request->emp_id;
        $vehicles = Current::getEmpWiseVehicleList($empName);

        $pdf = Pdf::loadView('sms.report.employeeWisePdf', compact('vehicles'))
                ->setPaper('a4', 'landscape');

        return $pdf->download('employee-wise-report.pdf');
    }

    public function empWiseDownloadExcel(Request $request)
    {
        $fileName = 'employee-wise-vehicle.xls';  

        $empName = $request->emp_id;
        $vehicles = Current::getEmpWiseVehicleList($empName);

        header('Content-Type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $file = fopen('php://output', 'w');
        
        fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
        fputcsv($file, []);
        fputcsv($file, [
            'Employee Name', 'Brand Name','Model Name','Engine No','Chassis No',
            'Registration No','Portfolio','Location','Receive Date','Usage Duration',
            'Is Loan','Registration Date','Registration Duration','Motor Cycle Status'
        ]);
        
        foreach ($vehicles as $vehicle) {
            fputcsv($file, [
                $vehicle->emp_name,
                $vehicle->brand_name,
                $vehicle->model_name,
                $vehicle->eng_no,
                $vehicle->chassis_no,
                $vehicle->registration_number,
                $vehicle->portfolio_name,
                $vehicle->location,
                $vehicle->receive_date,
                $vehicle->total_receive_duration,
                $vehicle->is_loan == 0 ? 'Loan' : 'Cash',
                $vehicle->reg_date,
                $vehicle->total_reg_duration,
                $vehicle->mc_status,
            ]);
        }

        fclose($file);
        exit;
    }

   public function chassisWiseDownloadPdf(Request $request)
    {
        $productId = $request->product_id;

        $vehicles = Current::chassisWiseVehicleList($productId);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('sms.report.chassisWisePdf', [
            'vehicles' => $vehicles,
        ])->setPaper('a4', 'landscape');

        $fileName = $productId 
            ? 'chassis-wise-report-' . $productId . '.pdf'
            : 'chassis-wise-report.pdf';

        return $pdf->download($fileName);
    }
    
    public function chassisWiseDownloadExcel(Request $request)
    {
        $fileName = 'chassis-wise-vehicle.xls';  

        $product = $request->product_id;
        $vehicles = Current::chassisWiseVehicleList($product);

        header('Content-Type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $file = fopen('php://output', 'w');

        fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
        fputcsv($file, []);
        fputcsv($file, [
            'Employee Name', 'Brand Name','Model Name','Engine No','Chassis No',
            'Registration No','Portfolio','Location','Receive Date','Usage Duration',
            'Is Loan','Registration Date','Registration Duration','Motor Cycle Status'
        ]);
        
        foreach ($vehicles as $vehicle) {
            fputcsv($file, [
                $vehicle->emp_name,
                $vehicle->brand_name,
                $vehicle->model_name,
                $vehicle->eng_no,
                $vehicle->chassis_no,
                $vehicle->registration_number,
                $vehicle->portfolio_name,
                $vehicle->location,
                $vehicle->receive_date,
                $vehicle->total_receive_duration,
                $vehicle->is_loan == 0 ? 'Loan' : 'Cash',
                $vehicle->reg_date,
                $vehicle->total_reg_duration,
                $vehicle->mc_status,
            ]);
        }

        fclose($file);
        exit;
    }
    
    public function eligibleUserDownloadPdf(Request $request)
    {
        $filter = $request->filter;

        $vehicles = Current::getEligibleUserList($filter);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('sms.report.eligibleUserPdf', [
            'vehicles' => $vehicles,
        ])->setPaper('a4', 'landscape');

        $fileName = $filter 
            ? 'eligible-user-report-' . $filter . '.pdf'
            : 'eligible-user-report.pdf';

        return $pdf->download($fileName);
    }

    public function assignVehicleDownloadPdf(Request $request)
    {
        $filter = $request->filter;

        $vehicles = Current::getAssignVehicleList($filter);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('sms.report.assignVehiclePdf', [
            'vehicles' => $vehicles,
        ])->setPaper('a4', 'landscape');

        $fileName = $filter 
            ? 'assign-vehicle-report-' . $filter . '.pdf'
            : 'assign-vehicle-report.pdf';

        return $pdf->download($fileName);
    }

    public function eligibleUserDownloadExcel(Request $request)
    {
        $fileName = 'eligible-user.xls';  

        $filter = $request->filter;
        $vehicles = Current::getEligibleUserList($filter);

        header('Content-Type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $file = fopen('php://output', 'w');

        fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
        fputcsv($file, []);
        fputcsv($file, [
            'Employee Name', 'Brand Name','Model Name','Engine No','Chassis No',
            'Registration No','Portfolio','Location','Receive Date','Usage Duration',
            'Is Loan','Registration Date','Registration Duration','Motor Cycle Status'
        ]);
        
        foreach ($vehicles as $vehicle) {
            fputcsv($file, [
                $vehicle->emp_name,
                $vehicle->brand_name,
                $vehicle->model_name,
                $vehicle->eng_no,
                $vehicle->chassis_no,
                $vehicle->registration_number,
                $vehicle->portfolio_name,
                $vehicle->location,
                $vehicle->receive_date,
                $vehicle->total_receive_duration,
                $vehicle->is_loan == 0 ? 'Loan' : 'Cash',
                $vehicle->reg_date,
                $vehicle->total_reg_duration,
                $vehicle->mc_status,
            ]);
        }

        fclose($file);
        exit;
    }

    public function assignVehicleDownloadExcel(Request $request)
    {
        $fileName = 'assign-vehicle.xls';  

        $filter = $request->filter;
        $vehicles = Current::getAssignVehicleList($filter);

        header('Content-Type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $file = fopen('php://output', 'w');

        fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
        fputcsv($file, []);
        fputcsv($file, [
            'Employee Name', 'Brand Name','Model Name','Engine No','Chassis No',
            'Registration No','Portfolio','Location','Receive Date','Usage Duration',
            'Is Loan','Registration Date','Registration Duration','Motor Cycle Status'
        ]);
        
        foreach ($vehicles as $vehicle) {
            fputcsv($file, [
                $vehicle->emp_name,
                $vehicle->brand_name,
                $vehicle->model_name,
                $vehicle->eng_no,
                $vehicle->chassis_no,
                $vehicle->registration_number,
                $vehicle->portfolio_name,
                $vehicle->location,
                $vehicle->receive_date,
                $vehicle->total_receive_duration,
                $vehicle->is_loan == 0 ? 'Loan' : 'Cash',
                $vehicle->reg_date,
                $vehicle->total_reg_duration,
                $vehicle->mc_status,
            ]);
        }

        fclose($file);
        exit;
    }
}



