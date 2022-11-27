<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Locations;

$factory->define(Locations::class, function (Faker $faker) {
    return [
        'location_name'=> $faker->country,
        'location_code'=>$faker->countryCode
    ];
});
