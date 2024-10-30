<?php

namespace Database\Seeders;

use App\Domain\Location\Models\Place;
use Illuminate\Database\Seeder;

class DevelopementSeeders extends Seeder
{
    public function run()
    {
        if(env('APP_ENV') == 'local'){
            Place::factory()->count(10)->create();
        }

    }
}
