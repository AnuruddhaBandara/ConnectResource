<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';
    protected $fillable = [
        'day',
        'check_in',
        'check_out',
        'schedule_id',
        'employee_id'
    ];

    public function employees(){
        return $this->belongsTo(Employees::class, 'employee_id', 'id');
    }
}
