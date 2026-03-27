<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MachineMaintenance extends Model
{
    protected $table = 'machine_maintenance';

    protected $primaryKey = 'maintenance_id';

    protected $fillable = [
        'machine_id',
        'reported_by',
        'description',
        'report_date',
        'status',
    ];

    // Maintenance report belongs to one machine
    public function machine()
    {
        return $this->belongsTo(Machine::class, 'machine_id', 'machine_id');
    }

    // Maintenance report belongs to one employee
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'reported_by', 'employee_id');
    }
}