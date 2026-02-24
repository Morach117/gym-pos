<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'barcode', 
        'name', 
        'price', 
        'stock', 
        'sat_product_code', 
        'sat_unit_code', 
        'is_active'
    ];
}