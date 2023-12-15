<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'type' => $this->faker->numberBetween(1,2),
            'document' => $this->faker->unique()->randomNumber($nbDigits = 8),
            'firstname' => $this->faker->name(),
            'lastname' => $this->faker->name(),
            'email' => $this->faker->unique()->email,
            'email_verified_at' => now(),
            'password' => Hash::make('123123123'), // password
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
