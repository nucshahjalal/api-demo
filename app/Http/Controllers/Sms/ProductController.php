<?php

namespace App\Http\Controllers\Sms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Product;

class ProductController extends Controller
{
    public $data = array();

    public function index(Request $request){

        $filter = $request->filter;
        $this->data['products'] = Product::getProducteList($filter);
        return view('sms.product.index', $this->data);
    }

    public function createForm(){

        return view('sms.product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'eng_no' => ['required','unique:products,eng_no'],
            'chassis_no' => ['required','unique:products,chassis_no'],
       ], [
            'eng_no.unique' => 'Engine no is already taken.',
            'chassis_no.unique' => 'Chassis no is required.',
            'eng_no.required' => 'Engine no is required.',
            'chassis_no.required' => 'Chassis no is required.',
        ]);
        
        $product  = Product::create($request->all());
        $product->status = 1;
        if($product){
            return redirect('product/list')->with('success','Product create successfull');
        }else{
            return redirect('product/create')->with('error','Product create failed');
        }
    }

    public function editForm(string $id)
    { 
       $this->data['product'] = Product::find($id);
       return view('sms.product.edit', $this->data);
    }

    public function update(Request $request)
    {
    
    $product = Product::findOrFail($request->id);

    $request->validate([
        'eng_no' => [
            'required',
            Rule::unique('products', 'eng_no')->ignore($product->id),
        ],
        'chassis_no' => [
            'required',
            Rule::unique('products', 'chassis_no')->ignore($product->id),
        ],
    ], [
        'eng_no.unique'   => 'Engine no is already taken.',
        'chassis_no.unique'   => 'Chassis no is already taken.',
    ]);

      $product->status = $request->status;
      $product->fill($request->all());
     
      if($product->update()){
        return redirect('product/list')->with('success','Product update successfull');
      }else{
         return redirect('product/edit/',$request->id)->with('error','Product update failed');
      }
    }

    public function view(string $id)
    { 
        $this->data['product'] = Product::find($id);
        return view('sms.product.view', $this->data);
    }

    public function destroy( $id)
    {
        $product  = Product::find($id);
        if($product->delete()){
            return redirect('product/list')->with('success','Product delete successfull');
        }else{
            return redirect('product/list')->with('error','Product delete failed');
        }
    } 
}
