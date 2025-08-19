<?php

namespace App\Http\Controllers\Sms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Employee,Product,Portfolio,Current};

class VehicleController extends Controller
{
    public $data = array();

    public function index(Request $request){

        $filter = $request->filter;
        $this->data['vehicles'] = Current::getCurrentList($filter);
        return view('sms.current.index', $this->data);
    }

    public function createForm(){

        $this->data['employees'] = Employee::where(['status'=>1])->get();
        $this->data['products'] = Product::where(['status'=>1])->get();
        $this->data['portfolios'] = Portfolio::where(['status'=>1])->get();
        return view('sms.current.create', $this->data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'emp_id' => ['required'],
            'product_id' => ['required'],
       ], [
            'emp_id.required' => 'Employee id is required.',
            'product_id.required' => 'Product id is required.',
        ]);
        
        $current  = Current::create($request->all());

        if($current){
            return redirect('vehicle/list')->with('success','Vehicle create successfull');
        }else{
            return redirect('vehicle/create')->with('error','Vehicle create failed');
        }
    }

    public function editForm(string $id)
    { 
       $this->data['employees'] = Employee::where(['status'=>1])->get();
       $this->data['products'] = Product::where(['status'=>1])->get();
       $this->data['portfolios'] = Portfolio::where(['status'=>1])->get();
       $this->data['vehicle'] = Current::find($id);
       return view('sms.current.edit', $this->data);
    }

    public function update(Request $request)
    {
    
        $current = Current::findOrFail($request->id);

        $request->validate([
                'emp_id' => ['required'],
                'product_id' => ['required'],
        ], [
                'emp_id.required' => 'Employee id is required.',
                'product_id.required' => 'Product id is required.',
        ]);

      $current->fill($request->all());
     
      if($current->update()){
        return redirect('vehicle/list')->with('success','Vehicle update successfull');
      }else{
         return redirect('vehicle/edit/',$request->id)->with('error','Vehicle update failed');
      }
    }

    public function view(string $id)
    { 
       $this->data['employees'] = Employee::where(['status'=>1])->get();
       $this->data['products'] = Product::where(['status'=>1])->get();
       $this->data['portfolios'] = Portfolio::where(['status'=>1])->get();
       $this->data['vehicle'] = Current::find($id);
       return view('sms.current.view', $this->data);
    }

    public function destroy( $id)
    {
        $current  = Current::find($id);
        if($current->delete()){
            return redirect('vehicle/list')->with('success','Vehicle delete successfull');
        }else{
            return redirect('vehicle/list')->with('error','Vehicle delete failed');
        }
    } 
}
