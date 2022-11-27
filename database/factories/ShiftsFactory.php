<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Shifts;

$factory->define(Shifts::class, function (Faker $faker) {
    $start_datetime = $faker->dateTimeBetween('next Monday', 'next Monday +7 days');
    return [
        'shift_start_time' => $start_datetime,
        'shift_end_time' => $faker->dateTimeBetween($start_datetime, $start_datetime->format('Y-m-d H:i:s').' +1 days'),
        'description' => $faker->text,
        'schedule_id' => function(){
            $schedue = \App\Schedules::inRandomOrder()->first();
            return $schedue->id;
        }
    ];
});
