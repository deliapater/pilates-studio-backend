<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition()
    {
        return [
            'class_id' => ClassModel::factory(),
            'user_id' => User::factory()
        ];
    }
}
