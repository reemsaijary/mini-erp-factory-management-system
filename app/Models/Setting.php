<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $primaryKey = 'setting_id';

    protected $fillable = [
        'factory_name',
        'phone',
        'email',
        'address',
        'currency',
        'timezone',
        'shift_start',
        'shift_end',
        'late_after_minutes',
    ];
}