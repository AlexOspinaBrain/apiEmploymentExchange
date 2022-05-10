<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KindidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kindids')->insert([
            'short_name' => 'CC',
            'name'=>'Cédula Ciudadanía'
        ]);
        DB::table('kindids')->insert([
            'short_name' => 'CE',
            'name'=>'Cédula Extrangería'
        ]);
    }
}
