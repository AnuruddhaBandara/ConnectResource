<?php

use Illuminate\Database\Seeder;
use App\Employees;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $count = 5;
        factory(Employees::class,$count)->create();
    }
}
