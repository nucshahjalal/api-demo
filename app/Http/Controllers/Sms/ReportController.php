<?php

namespace App\Http\Controllers\Sms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Employee,Product,Portfolio,Current};
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public $data = array();

    public function ongoindDownloadPdf(Request $request){

        $filter = $request->filter;
        $vehicles = Current::getVehicleList($filter);
        $pdf = Pdf::loadView('sms.current.ongoingPdf', compact('vehicles'))->setPaper('a4', 'landscape');
        return $pdf->download('ongoingPdf');
    }

    public function ongoindDownloadExcel(Request $request)
    {
        $fileName = 'ongoing-vehicle.xls';

        $filter = $request->filter;
        $vehicles = Current::getVehicleList($filter);

        header('Content-Type: text/csv');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $file = fopen('php://output', 'w');

        fputcsv($file, 
        []
        // ['Employee Name', 'Brand Name','Brand Name','Engine No','Chassis No',
       //'Registration No','Portfolio','Location','Receive Date','Usage Duration','Registration Date','Registration Duration','Motor Cycle Status']
    );

    foreach ($vehicles as $vehicle) {
        fputcsv($file, [
            $vehicle->emp_name,
            $vehicle->model_name,
            $vehicle->brand_name,
            $vehicle->eng_no,
            $vehicle->chassis_no,
            $vehicle->registration_number,
            $vehicle->portfolio_name,
            $vehicle->location,
            $vehicle->receive_date,
            $vehicle->total_receive_duration,
            $vehicle->reg_date,
            $vehicle->total_reg_duration,
            $vehicle->mc_status,
        ]);
    }

    fclose($file);
    exit;
    }

    
}
