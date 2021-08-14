<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            [
                'first_name' => 'Thalles',
                'last_name' => 'Rangel',
                'email' => 'thalles@gmail.com',
                'flag_status' => 'enabled',
            ],
            [
                'first_name' => 'Micaelly',
                'last_name' => 'Karina',
                'email' => 'karina@gmail.com',
                'flag_status' => 'enabled',
            ],
            [
                'first_name' => 'Bruno',
                'last_name' => 'Rodrigues',
                'email' => 'bruno@gmail.com',
                'flag_status' => 'disabled',
            ]
        ]);
    }
}