<?php

use Illuminate\Database\Seeder;
use App\Shifts;

class ShiftsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 5;
        factory(Shifts::class,$count)->create();
    }
}
