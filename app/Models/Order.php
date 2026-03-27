<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';//This model is connected to the orders table in the database.
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'product_id',
        'created_by',
        'quantity',
        'order_date',
        'due_date',
        'priority',
        'order_status',
    ];

    // Order belongs to one product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    // Order belongs to one employee (the one who created it)
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'created_by', 'employee_id');
    }

    // One order can have many production records
    public function productions()
    {
        return $this->hasMany(Production::class, 'order_id', 'order_id');
    }
}