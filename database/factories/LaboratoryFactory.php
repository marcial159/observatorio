<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class LaboratoryFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(2,false),
            'ambient' => $this->faker->sentence(2,false),
        ];
    }
}
