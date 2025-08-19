<?php

namespace App\Http\Controllers\Sms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Portfolio;

class PortfolioController extends Controller
{
    public $data = array();

    public function index(Request $request){

        $filter = $request->filter;
        $this->data['portfolios'] = Portfolio::getPortfolioList($filter);
        return view('sms.portfolio.index', $this->data);
    }

    public function createForm(){
        return view('sms.portfolio.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required',],
        ], [
            'name.required'   => 'Name id is required.',
        ]);
        
        $request->merge(['status'=> 1]); 
        $portfolio  = Portfolio::create($request->all());
        
        if($portfolio){
            return redirect('portfolio/list')->with('success','Portfolio create successfull');
        }else{
            return redirect('portfolio/create')->with('error','Portfolio create failed');
        }
    }

    public function editForm(string $id)
    { 
        $this->data['portfolio'] = Portfolio::find($id);
        return view('sms.portfolio.edit', $this->data);
    }

    public function update(Request $request)
    {
    
        $portfolio = Portfolio::findOrFail($request->id);

        $request->validate([
            'name' => ['required',],
        ], [
            'name.required'   => 'Name id is required.',
        ]);

        $portfolio->status = $request->status;
        $portfolio->fill($request->all());
        
        if($portfolio->update()){
            return redirect('portfolio/list')->with('success','Portfolio update successfull');
        }else{
            return redirect('portfolio/edit/',$request->id)->with('error','Portfolio update failed');
        }
    }

    public function destroy( $id)
    {
        $portfolio  = Portfolio::find($id);
        if($portfolio->delete()){
            return redirect('portfolio/list')->with('success','Portfolio delete successfull');
        }else{
            return redirect('portfolio/list')->with('error','Portfolio delete failed');
        }
    } 
}
