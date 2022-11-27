<?php

use Illuminate\Database\Seeder;
use App\Schedules;
class SchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 3;
        factory(Schedules::class,$count)->create();
    }
}
