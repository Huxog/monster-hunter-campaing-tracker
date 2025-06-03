<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Map;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Map::all()->each(function ($map) {
            Campaign::factory(5)->create([
                'mapId'=> $map->id,
            ]);
        });
    }
}
