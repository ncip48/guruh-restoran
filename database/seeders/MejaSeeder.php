<?php

namespace Database\Seeders;

use App\Models\Meja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MejaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Meja::insert(
            [
                [
                    'no_meja' => 1,
                    'status' => 1,
                ], [
                    'no_meja' => 2,
                    'status' => 1,
                ], [
                    'no_meja' => 3,
                    'status' => 1,
                ], [
                    'no_meja' => 4,
                    'status' => 1,
                ], [
                    'no_meja' => 5,
                    'status' => 1,
                ]
            ]
        );
    }
}
