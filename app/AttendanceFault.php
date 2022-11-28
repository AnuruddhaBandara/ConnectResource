<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendanceFault extends Model
{
    protected $table = 'attendance_fault';
    protected $fillable = [
        'description',
        'attendance_id'
    ];
}
