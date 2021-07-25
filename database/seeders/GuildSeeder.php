<?php

namespace Database\Seeders;

use App\Models\Guild;
use Illuminate\Database\Seeder;

class GuildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Guild::factory()->count(10)->create();
    }
}
