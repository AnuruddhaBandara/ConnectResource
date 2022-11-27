<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Schedules;

$factory->define(Schedules::class, function (Faker $faker) {
    return [
        'description' => $faker->text,
        'employee_id'=> function(){
            $employees = \App\Employees::inRandomOrder()->first();
            return $employees->id;
        },
        'location_id' => function(){
            $locations = \App\Locations::inRandomOrder()->first();
            return $locations->id;
        }
    ];
});
