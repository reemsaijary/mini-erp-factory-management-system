<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    protected $primaryKey = 'machine_id';

    protected $fillable = [
        'machine_type',
        'machine_name',
        'purchase_date',
        'machine_status',
    ];

    // One machine can be used in many production records
    public function productions()
    {
        return $this->hasMany(Production::class, 'machine_id', 'machine_id');
    }

    // One machine can have many maintenance reports
    public function maintenanceReports()
    {
        return $this->hasMany(MachineMaintenance::class, 'machine_id', 'machine_id');
    }
}