<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function getProductList($filter) {
        
        $products = Employee::from('products as P')
                    ->where('P.eng_no', 'like', '%'.$filter.'%')
                    ->orWhere('P.chassis_no', 'like', '%'.$filter.'%')
                    ->orWhere('P.brand', 'like', '%'.$filter.'%')
                    ->orWhere('P.model', 'like', '%'.$filter.'%')
                    ->orderBy('P.id','desc')
                    ->paginate(10, array('P.*'));
        return $products;
    }
  
}
