<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EncodeFile extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = ['file_name'];
    
    //  protected $casts = [
    //     'file' => 'array'
    // ];
}
