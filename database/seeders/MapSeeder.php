<?php

namespace Database\Seeders;

use App\Models\Map;
use Illuminate\Database\Seeder;

class MapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Map::factory(10)->create();
    }
}
