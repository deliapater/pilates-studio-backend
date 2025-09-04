<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClassesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('classes')->insert([
            [
                'className' => 'Pilates Beginner',
                'instructor' => 'Alice',
                'time' => '09:00 AM',
                'spots' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'className' => 'Pilates Intermediate',
                'instructor' => 'Bob',
                'time' => '11:00 AM',
                'spots' => 8,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'className' => 'Pilates Advanced',
                'instructor' => 'Clara',
                'time' => '01:00 PM',
                'spots' => 6,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}