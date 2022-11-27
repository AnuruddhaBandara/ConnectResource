<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    protected $table = 'schedules';
    protected $fillable =[
        'description',
        'employee_id',
        'locations_id'
    ];
}


