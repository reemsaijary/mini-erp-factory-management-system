<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{ 
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'product_name',
        'product_type',
        'description',
        'unit_price',
    ];

    // One product can be included in many orders
    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id', 'product_id');
    } 
}
