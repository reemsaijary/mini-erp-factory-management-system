<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $table = 'payroll';

    protected $primaryKey = 'payroll_id';

    protected $fillable = [
        'employee_id',
        'month',
        'year',
        'basic_salary',
        'overtime',
        'deductions',
        'bonus',
        'net_salary',
        'status',
    ];

    // Payroll record belongs to one employee
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }
}