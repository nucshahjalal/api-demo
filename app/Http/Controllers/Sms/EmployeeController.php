<?php

namespace App\Http\Controllers\Sms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public $data = array();

    public function index(Request $request){

        $filter = $request->filter;
        $this->data['employees'] = Employee::getEmployeeList($filter);
        return view('sms.employee.index', $this->data);
    }

    public function createForm(){
        return view('sms.employee.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'emp_id' => ['required', 'unique:employees,emp_id'],
        ], [
            'emp_id.unique'   => 'Employee id is already taken.',
            'emp_id.required'   => 'Employee id is required.',
        ]);
        
        $employee  = Employee::create($request->all());
        $employee->status = 1;
        if($employee){
            return redirect('employee/list')->with('success','Employee create successfull');
        }else{
            return redirect('employee/create')->with('error','Employee create failed');
        }
    }

    public function editForm(string $id)
    { 
       $this->data['employee'] = Employee::find($id);
       return view('sms.employee.edit', $this->data);
    }

    public function update(Request $request)
    {
    
    $employee = Employee::findOrFail($request->id);

    $request->validate([
        'emp_id' => [
            'required',
            Rule::unique('employees', 'emp_id')->ignore($employee->id),
        ],
        ], [
        'emp_id.unique'   => 'Employee id is already taken.',
        'emp_id.required'   => 'Employee id is required.',
    ]);

      $employee->status = $request->status;
      $employee->fill($request->all());
     
      if($employee->update()){
        return redirect('employee/list')->with('success','Employee update successfull');

      }else{
         return redirect('employee/edit/',$request->id)->with('error','Employee update failed');
      }
    }

    public function view(string $id)
    { 
        $this->data['employee'] = Employee::find($id);
        return view('sms.employee.view', $this->data);
    }

    public function destroy( $id)
    {
        $employee  = Employee::find($id);
        if($employee->delete()){
            return redirect('employee/list')->with('success','Employee delete successfull');
        }else{
            return redirect('employee/list')->with('error','Employee delete failed');
        }
    } 
}
