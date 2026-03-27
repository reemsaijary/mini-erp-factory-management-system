<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance';

    protected $primaryKey = 'attendance_id';

    protected $fillable = [
        'employee_id',
        'attendance_date',
        'check_in',
        'check_out',
        'status',
    ];

    // Attendance record belongs to one employee
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }
}