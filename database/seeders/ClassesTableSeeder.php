<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClassesTableSeeder extends Seeder
{
    public function run()
    {
        ClassModel::factory()->count(3)->create();
    }
}
