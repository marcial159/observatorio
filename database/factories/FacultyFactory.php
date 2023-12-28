<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class FacultyFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(2,false),
            'acronym' => $this->faker->sentence(2,false),
        ];
    }
}
