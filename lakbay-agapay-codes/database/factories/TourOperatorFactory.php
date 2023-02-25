<?php

namespace Database\Factories;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class TourOperatorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::pluck('id')->toArray();
        return [
            'user_id' => $this->faker->randomElement($users),
            'operator_company' => $this->faker->company(),
            'operator_main_picture' => "https://source.unsplash.com/random",
            'operator_location' => $this->faker->address(),
            'operator_city' =>$this->faker->randomElement(['Bacacay','Camalig','Daraga','Guinobatan','Jovellar','Legazpi','Libon','Ligao','Malilipot','Malinao','Manito','Oas','Pio Duran','Polangui','RapuRapu','Santo Domingo','Tabaco','Tiwi']),
            'operator_description' => $this->faker->paragraph(),
            'operator_services' => $this->faker->paragraph(),
            'operator_email' => $this->faker->safeEmail(),
            'operator_phone_number' =>$this->faker->phoneNumber(),
            'operator_fb' => $this->faker->url(),
            'operator_twitter' => $this->faker->url(),
            'operator_instagram' => $this->faker->url(),
            'operator_website' => $this->faker->url(),
            'operator_approval' => $this->faker->randomElement(['Approved','Pending','Rejected']),
            'operator_reasons' => $this->faker->paragraph(),
            'to_rating_average'=> '0'
        ];
    }
}
