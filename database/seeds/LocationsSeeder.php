<?php

use Illuminate\Database\Seeder;
use App\Locations;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 5;
        factory(Locations::class,$count)->create();
    }
}
