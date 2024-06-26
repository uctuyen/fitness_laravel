<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        foreach (range(1, 5) as $index) {
            DB::table('majors')->insert([
                'major_name' => $faker->word,
                // Add more fields as necessary
            ]);
        }
    }
}
