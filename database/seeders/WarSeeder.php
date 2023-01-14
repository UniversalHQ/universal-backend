<?php

namespace Database\Seeders;

use App\Models\War;
use App\WarApi\WarApiService;
use Illuminate\Database\Seeder;

class WarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var WarApiService $service */
        $service = app(WarApiService::class);
        $service->updateWar();
        War::getCurrentWar()->update(['active_tiles_string' => '']);
        $service->updateMaps();
    }
}
