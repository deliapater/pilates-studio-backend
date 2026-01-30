<?php

namespace Database\Factories;

use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassModelFactory extends Factory
{
    protected $model = ClassModel::class;

    public function definition()
    {
        return [
            'className'  => $this->faker->randomElement(['Pilates Beginner', 'Pilates Intermediate', 'Pilates Advance']),
            'instructor' => $this->faker->name(),
            'time'       => $this->faker->time('H:i'),
            'spots'      => $this->faker->numberBetween(5, 20),
            'day'        => $this->faker->randomElement([
                'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'
            ]),
        ];
    }
}