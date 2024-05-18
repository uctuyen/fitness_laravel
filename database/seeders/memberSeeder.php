<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class memberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Member::factory()->count(100)->create();
    }
}
