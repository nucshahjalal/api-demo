<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Current extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function getCurrentList($filter) {
        
        $currents = Current::from('currents as C')
                    ->join('employees AS E', 'E.id', '=', 'C.emp_id')
                    ->join('products AS P', 'P.id', '=', 'C.product_id')
                    ->where('C.emp_id', 'like', '%'.$filter.'%')
                    ->orWhere('C.product_id', 'like', '%'.$filter.'%')
                    ->orWhere('C.portfolio', 'like', '%'.$filter.'%')
                    ->orWhere('C.location', 'like', '%'.$filter.'%')
                    ->orderBy('C.id','desc')
                    ->paginate(5, array('C.*','E.name as emp_name','P.brand as brand_name','P.model as model_name'));
        return $currents;
    }
  
}
