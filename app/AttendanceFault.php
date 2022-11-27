<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendanceFault extends Model
{
    protected $table = 'attandence_fault';
    protected $fillable = [
        'description',
        'attendance_id'
    ];
}
