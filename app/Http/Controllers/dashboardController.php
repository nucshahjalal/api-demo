<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Employee, Product, Current};
use DB;
class dashboardController extends Controller
{
    public $data = array();

    public function dashboard(Request $request){

        $total_employee = Employee::all()->count();
        $total_vehicle = Current::all()->count();
        $active_vehicle = Current::where('status', 0)->count();
        $total_transfered = Current::where('status', 1)->count();
        $vehicles = Current::where('status', 0)->get();

        $totalVehicleCount = [Current::all()->count()];
        $vehicle_id = $request->vehicle_id;

        $activeMonthly = Current::where('status', 0)
                //->where('id', $vehicle_id)
                ->select(DB::raw('MONTH(created_at) as month'),
                    DB::raw('COUNT(*) as total')
                )->groupBy('month')->pluck('total','month');

            $activeVehicles = [];
            for ($i = 1; $i <= 12; $i++) {
                $activeVehicles[] = $activeMonthly[$i] ?? 0; 
            }

        $months = ['January','February','March','April','May','June','July','August','September',
                  'October','November','December'];

        return view('backend.dashboard', compact('total_employee','total_vehicle','active_vehicle'
            ,'total_transfered','vehicles','months','activeVehicles','totalVehicleCount'));
        }

    public function main(){
        return view('backend.app');
    }

    public function template(){
        return view('backend.dashboard');
    }
}
