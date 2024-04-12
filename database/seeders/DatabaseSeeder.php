<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Member;
use App\Models\Trainer;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            // employeeSeeder::class,
            // memberSeeder::class,
            // trainerSeeder::class
            majorSeeder::class 
        ]);
    }
}
