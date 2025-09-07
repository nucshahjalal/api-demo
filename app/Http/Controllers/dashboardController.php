<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Employee, Product, Current};

class dashboardController extends Controller
{
    public $data = array();

    public function dashboard(){

        $this->data['total_employee'] = Employee::all()->count();
        $this->data['total_chesis_no'] = Product::whereNotNull('chassis_no')->count();
        $this->data['total_vehicle'] = Current::where('status', 0)->count();
        $this->data['total_transfered'] = Current::where('status', 1)->count();
        return view('backend.dashboard', $this->data);
    }

    public function main(){
        return view('backend.app');
    }

    public function template(){
        return view('backend.dashboard');
    }
}
