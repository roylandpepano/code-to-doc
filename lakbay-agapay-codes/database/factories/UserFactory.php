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
            'user_type' => $this->faker->randomElement(['Admin', 'Tourist', 'Tour Operator', 'Super Admin', 'Owner']),
            'user_picture' => "https://source.unsplash.com/random/500x500",
            'user_fname' => $this->faker->firstName(),
            'user_mname' => $this->faker->lastName(),
            'user_lname' => $this->faker->lastName(),
            'user_address' => $this->faker->address(),
            'user_phone' => $this->faker->phoneNumber(),
            'user_username' => $this->faker->userName(),
            'google_id' => rand(1,100),
            'user_email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_logged_in_using' => $this->faker->randomElement(['Facebook', 'Google', 'Email']),
            'google_id' =>$this->faker->numberBetween(10000, 99999),
            'remember_token' => Str::random(10),
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
