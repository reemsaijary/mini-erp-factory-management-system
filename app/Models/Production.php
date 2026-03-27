<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    protected $table = 'production';

    protected $primaryKey = 'production_id';

    protected $fillable = [
        'order_id',
        'machine_id',
        'employee_id',
        'start_date',
        'end_date',
        'production_status',
    ];

    // Production belongs to one order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    // Production belongs to one machine
    public function machine()
    {
        return $this->belongsTo(Machine::class, 'machine_id', 'machine_id');
    }

    // Production belongs to one employee
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }
}