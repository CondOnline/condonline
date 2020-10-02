<?php

namespace Database\Factories;

use App\Models\Residence;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResidenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Residence::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => $this->faker->buildingNumber,
            'block' => $this->faker->lexify('?'),
            'lot' => $this->faker->numerify('#'),
            'extension' => $this->faker->unique()->numerify('####')
        ];
    }
}
