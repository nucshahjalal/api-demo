<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class dashboardController extends Controller
{
    public $data = array();

    public function dashboard(Request $request){

        return view('backend.dashboard');
    }

    public function about(Request $request){

        return view('portfolio.index');
    }
    
}
