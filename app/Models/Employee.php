<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $primaryKey = 'employee_id';
    protected $fillable = [
        'first_name',
        'last_name',
        'basic_salary',
        'phone',
        'status'
    ];
     // Employee has one User account
    public function user()
    {
        return $this->hasOne(User::class, 'employee_id');
    }

    // Employee creates many Orders
    public function orders()
    {
        return $this->hasMany(Order::class, 'created_by');
    }

    // Employee works in Production
    public function productions()
    {
        return $this->hasMany(Production::class, 'employee_id');
    }

    // Employee attendance records
  public function attendances()
{
    return $this->hasMany(Attendance::class, 'employee_id', 'employee_id');
}

    // Employee payroll records
    public function payrolls()
    {
        return $this->hasMany(Payroll::class, 'employee_id');
    }

    // Employee reports machine maintenance
    public function maintenanceReports()
    {
        return $this->hasMany(MachineMaintenance::class, 'reported_by');
    }
}
