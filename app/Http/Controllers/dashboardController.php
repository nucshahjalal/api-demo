<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Employee, Product, Current};
use DB;

class dashboardController extends Controller
{
    public $data = array();

    public function dashboard(Request $request){

        $this->data['total_employee'] = Employee::all()->count();
        $this->data['total_vehicle'] = Current::all()->count();
        $this->data['active_vehicle']= Current::where('status', 0)->count();
        $this->data['total_transfered'] = Current::where('status', 1)->count();
        $this->data['vehicles'] = Current::where('status', 0)->get();
                            // Current::where('status', 0)
                            // ->select(DB::raw('DISTINCT YEAR(created_at) as year'))
                            // ->pluck('year');

        $this->data['totalVehicleCount'] = [Current::all()->count()];
        $year_id = $request->year_id;

        $activeMonthly = Current::where('status', 0)
           // ->whereYear('created_at', $year_id)
            ->select(DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total')
            )->groupBy('month')->pluck('total','month');

            $this->data['activeVehicles'] = [];
            for ($i = 1; $i <= 12; $i++) {
                $this->data['activeVehicles'][] = $activeMonthly[$i] ?? 0; 
            }

        $this->data['months'] = ['January','February','March','April','May','June','July','August','September',
            'October','November','December'];

        return view('backend.dashboard', $this->data);
    }
}
