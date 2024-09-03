<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::create(
            [
                'date' => '2024-09-01',
                'price' => 100000,
                'kuota' => 5,
            ],
        );

        Schedule::create(
            [
                'date' => '2024-09-02',
                'price' => 200000,
                'kuota' => 10
            ],
        );

        Schedule::create(
            [
                'date' => '2024-09-03',
                'price' => 300000,
                'kuota' => 15
            ],
        );
    }
}
