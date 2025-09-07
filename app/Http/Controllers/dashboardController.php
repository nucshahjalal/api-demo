<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Employee, Product, Current};

class dashboardController extends Controller
{
    public $data = array();

    public function dashboard(){

        $this->data['total_employee'] = Employee::all()->count();
        $this->data['total_vehicle'] = Current::all()->count();
        $this->data['active_vehicle'] = Current::where('status', 0)->count();
        $this->data['total_transfered'] = Current::where('status', 1)->count();
        $this->data['vehicles'] = Current::where('status', 0)->get();
        return view('backend.dashboard', $this->data);
    }

    public function main(){
        return view('backend.app');
    }

    public function template(){
        return view('backend.dashboard');
    }
}
