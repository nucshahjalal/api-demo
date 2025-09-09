<?php

namespace App\Http\Controllers\Sms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Employee,Product,Portfolio,Current};

class VehicleController extends Controller
{
    public $data = array();

    /**---------index-----------
    * display ongoing list data file = index page
    * show data ongoing vehicle active data
    * current table column status = 0, active data list
    * @throws \Illuminate\Validation\ValidationException
    */
    public function index(Request $request){

        $filter = $request->filter;
        $this->data['vehicles'] = Current::getVehicleList($filter);
        return view('sms.current.index', $this->data);
    }
    
    /**---------transferVehicle-----------
    * display transfer vehicle page
    * show data transfer vehicle  data
    * current table column status = 1
    * @throws \Illuminate\Validation\ValidationException
    */
    public function transferVehicle(Request $request){

        $filter = $request->filter;
        $this->data['vehicles'] = Current::getTransferList($filter);
        return view('sms.current.transferVehicle', $this->data);
    }

    /**---------empWiseVehicle-----------
    * display employee vehicle page
    * show data employee wise vehicle data
    * table query current and empyloyee table
    * @throws \Illuminate\Validation\ValidationException
    */
    public function empWiseVehicle(Request $request){

        $emp_id = $request->emp_id;
        $this->data['employees'] = Employee::where(['status'=>1])->get();
        $this->data['vehicles'] = Current::getEmpWiseVehicleList($emp_id);
        return view('sms.current.empWiseVehicle', $this->data);
    }

    /**---------chassisWiseVehicle-----------
    * display chassis vehicle page
    * show data chassis wise vehicle data
    * table query current and product table
    * @throws \Illuminate\Validation\ValidationException
    */
    public function chassisWiseVehicle(Request $request){

        $product = $request->product_id;
        $this->data['products'] = Product::where(['status'=>1])->get();
        $this->data['vehicles'] = Current::chassisWiseVehicleList($product);
        return view('sms.current.ChassisWiseVehicle', $this->data);
    }

    /**---------eligibleUser-----------
    * display eligible vehicle page
    * show data eligible vehicle data
    * if is loan = loan, usage duration 5 years or more 
    * if is loan = cash, usage duration 6 years or more 
    * @throws \Illuminate\Validation\ValidationException
    */
    public function eligibleUser(Request $request){

        $filter = $request->filter;
        $this->data['vehicles'] = Current::getEligibleUserList($filter);
        return view('sms.current.eligibleUser', $this->data);
    }

    /**---------assignVehicle-----------
    * display assign vehicle page
    * show data current table column is assing = 0
    * if is assing column = 1 update method call
    * @throws \Illuminate\Validation\ValidationException
    */
    public function assignVehicle(Request $request){

        $filter = $request->filter;
        $this->data['vehicles'] = Current::getAssignVehicleList($filter);
        return view('sms.current.assignVehicle', $this->data);
    }

    /**---------createForm-----------
    * display current create page
    * @throws \Illuminate\Validation\ValidationException
    */
    public function createForm(){

        $this->data['employees'] = Employee::where(['status'=>1])->get();
        $this->data['products'] = Product::where(['status'=>1])->get();
        $this->data['portfolios'] = Portfolio::where(['status'=>1])->get();
        return view('sms.current.create', $this->data);
    }

    /**---------transferForm-----------
    * display current create transfer form page
    * @throws \Illuminate\Validation\ValidationException
    */
    public function transferForm(string $id){

        $this->data['employees'] = Current::getEmployeeList();
        $this->data['products'] = Product::where(['status'=>1])->get();
        $this->data['portfolios'] = Portfolio::where(['status'=>1])->get();
        $this->data['vehicle'] = Current::find($id);
        return view('sms.current.transfer', $this->data);
    }

    /**---------store-----------
    * display current create  page
    * submit form and store data current table
    * @throws \Illuminate\Validation\ValidationException
    */
    public function store(Request $request)
    {
        $request->validate([
            'emp_id' => ['required'],
            'product_id' => ['required'],
            'portfolio_id' => ['required'],
       ], [
            'emp_id.required' => 'Employee name is required.',
            'product_id.required' => 'Product name is required.',
            'portfolio_id.required' => 'Portfolio name is required.',
        ]);
        
        $current  = Current::create($request->all());

        if($current){
            return redirect('vehicle/list')->with('success','Vehicle create successfull');
        }else{
            return redirect('vehicle/create')->with('error','Vehicle create failed');
        }
    }

    /**---------editForm-----------
    * display current edit  page
    * edit page display data
    * @throws \Illuminate\Validation\ValidationException
    */
    public function editForm(string $id)
    { 
       $this->data['employees'] = Employee::where(['status'=>1])->get();
       $this->data['products'] = Product::where(['status'=>1])->get();
       $this->data['portfolios'] = Portfolio::where(['status'=>1])->get();
       $this->data['vehicle'] = Current::find($id);
       return view('sms.current.edit', $this->data);
    }

    /**---------update-----------
    * display current  edit  page
    * submit form and update data current table
    * @throws \Illuminate\Validation\ValidationException
    */
    public function update(Request $request)
    {
    
        $current = Current::findOrFail($request->id);

        $request->validate([
                'emp_id' => ['required'],
                'product_id' => ['required'],
                'portfolio_id' => ['required'],
        ], [
                'emp_id.required' => 'Employee name is required.',
                'product_id.required' => 'Product name is required.',
                'portfolio_id.required' => 'Portfolio name is required.',
        ]);

      $current->fill($request->all());
     
      if($current->update()){
        return redirect('vehicle/list')->with('success','Vehicle update successfull');
      }else{
         return redirect('vehicle/edit/',$request->id)->with('error','Vehicle update failed');
      }
    }

    /**---------vehicleTransfer-----------
    * click transfer button display create page
    * submit form and update and store data current table
    * @throws \Illuminate\Validation\ValidationException
    */
    public function vehicleTransfer(Request $request)
    {
    
        $request->validate([
                'product_id' => ['required'],
                'emp_id' => ['required'],
                'portfolio_id' => ['required'],
        ], [
                'emp_id.required' => 'Employee name is required.',
                'product_id.required' => 'Product name is required.',
                'portfolio_id.required' => 'Portfolio name is required.',
        ]);

        $current = Current::create($request->all());

        if($current){
            return redirect('vehicle/list')->with('success','Vehicle create successfull');
        }else{
            return redirect('vehicle/create')->with('error','Vehicle create failed');
        }
    }

    /**---------view-----------
    * display current table view page
    * show display data
    * @throws \Illuminate\Validation\ValidationException
    */
    public function view(string $id)
    { 
       $this->data['employees'] = Employee::where(['status'=>1])->get();
       $this->data['products'] = Product::where(['status'=>1])->get();
       $this->data['portfolios'] = Portfolio::where(['status'=>1])->get();
       $this->data['vehicle'] = Current::find($id);
       return view('sms.current.view', $this->data);
    }

    /**---------updateStatus-----------
    * display ongoing page = index page 
    * submit transfer button update current table data
    * @throws \Illuminate\Validation\ValidationException
    */
    public function updateStatus(Request $request)
    {
        $current = Current::find($request->id);

        if (!$current) {
            return response()->json(['success' => 'Data not found'], 404);
        }

        $current->status = 1;
        $current->transfer_at = now();
        $current->save();
    }

    /**---------handOver-----------
    * display eligable page 
    * submit handover button update current table data
    * @throws \Illuminate\Validation\ValidationException
    */
    public function handOver(Request $request)
    {
        $current = Current::find($request->id);

        if (!$current) {
            return response()->json(['success' => 'Data not found'], 404);
        }

        $current->is_assign = 1;
        $current->updated_at = now();
        $current->save();
    }
}
