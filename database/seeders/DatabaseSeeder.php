<?php

namespace Database\Seeders;

use App\Models\Joboffer;
use App\Models\User;
use App\Models\User_offer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(KindidSeeder::class);
        User::factory(20)->create();
        Joboffer::factory(40)->create();
        User_offer::factory(100)->create();
    }
}
