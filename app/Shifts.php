<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shifts extends Model
{
    protected $table='shifts';
    protected $fillable=[
        'shift_start_time',
        'shift_end_time',
        'description',
        'schedule_id'
    ];
}
