<?php

namespace Database\Factories;

use App\Models\TableSchedule;
use Illuminate\Database\Eloquent\Factories\Factory;

class TableScheduleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TableSchedule::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'date_of_birth' => $this->faker->date,
            'cpf' => $this->faker->numerify('###########'),
            'phone' => $this->faker->numerify('###########'),
        ];
    }
}
