<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EmployeesSeeder::class);
        $this->call(LocationsSeeder::class);
        $this->call(SchedulesSeeder::class);
        $this->call(ShiftsSeeder::class);
    }
}
