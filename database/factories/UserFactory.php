<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'type' => $this->faker->randomElement([1,2,3]),
            'user_number' => Str::random(2),
            'phone_number' => $this->faker->phoneNumber(),
            'from' => $this->faker->city(),
            'shift_id' => $this->faker->randomElement(['bbc016fc-9b41-4ceb-a5cd-b1242f4b67df', 'e5c8e25b-070a-4987-a749-891ed52bf87c']),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
