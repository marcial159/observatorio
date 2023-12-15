<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class HeadquarterFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(2,false),
            'position' => $this->faker->sentence(2,false),
        ];
    }
}
