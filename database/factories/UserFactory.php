<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_access_group_id' => 2,
            'name' => $this->faker->name,
            'cpf' => $this->faker->unique()->numerify('###.###.###-##'),
            'rg' => $this->faker->unique()->numerify('##.###.###-#'),
            'gender' => $this->faker->randomElement($array = array ('male','female')),
            'mobile_phone' => $this->faker->unique()->numerify('(##) #####-####'),
            'birth' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'dweller' => 1,
            'blocked' => 0,
            'first_login' => 0,
            'email' => $this->faker->regexify('[a-z]+[a-z0-9._-]+[a-z0-9.-]+\.[a-z]{1,5}').'@diogofmedeiros.com',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }
}
