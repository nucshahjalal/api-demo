<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Portfolio extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function getPortfolioList($filter) {
        
        $portfolios = Portfolio::from('portfolios as P')
                    ->where('P.name', 'like', '%'.$filter.'%')
                    ->orderBy('P.id','desc')
                    ->paginate(10, array('P.*'));
        return $portfolios;
    }
  
}
