<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function getEmployeeList($filter) {
        
        $employees = Employee::from('employees as E')
                    ->where('E.emp_id', 'like', '%'.$filter.'%')
                    ->orWhere('E.name', 'like', '%'.$filter.'%')
                    ->orWhere('E.designation', 'like', '%'.$filter.'%')
                    ->orWhere('E.phone', 'like', '%'.$filter.'%')
                    ->orderBy('E.id','desc')
                    ->paginate(10, array('E.*'));
        return $employees;
    }
  
}
