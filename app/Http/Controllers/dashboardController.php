<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function dashboard(){
       // dd('test');
        return view('backend.dashboard');
    }

    public function main(){
        return view('backend.app');
    }

    public function template(){
        return view('backend.dashboard');
    }
}
