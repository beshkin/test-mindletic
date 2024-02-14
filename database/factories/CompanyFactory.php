<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->company,
            'registration_number'=>$this->faker->randomNumber(),
            'address'=>$this->faker->address,
            'city'=>$this->faker->city,
            'country'=>$this->faker->country,
            'balance'=>0,
        ];
    }
}
