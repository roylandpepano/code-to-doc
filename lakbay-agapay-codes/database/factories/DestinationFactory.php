<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DestinationFactory extends Factory
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
            'dest_owner' => $this->faker->randomElement($users),
            'dest_longitude' =>$this->faker->longitude(),
            'dest_latitude' =>$this->faker->latitude(),
            'dest_main_picture' => "https://source.unsplash.com/random",
            'dest_name' =>$this->faker->city(),
            'dest_city' =>$this->faker->randomElement(['Bacacay','Camalig','Daraga','Guinobatan','Jovellar','Legazpi','Libon','Ligao','Malilipot','Malinao','Manito','Oas','Pio Duran','Polangui','RapuRapu','Santo Domingo','Tabaco','Tiwi']),
            'dest_address' =>$this->faker->address(),
            'dest_phone' =>$this->faker->phoneNumber(),
            'dest_email' => $this->faker->safeEmail(),
            'dest_date_opened' =>$this->faker->date(),
            'dest_working_hours' =>$this->faker->time(),
            'dest_description' =>$this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'dest_direction' =>$this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'dest_fare' =>$this->faker->sentence(6, true),
            'dest_entrance_fee' =>$this->faker->randomNumber(),
            'dest_category' =>$this->faker->randomElement(['Park','Water','Land','Air']),
            'dest_fb' =>$this->faker->domainWord(),
            'dest_twt' =>$this->faker->domainWord(),
            'dest_ig' =>$this->faker->domainWord(),
            'dest_web' =>$this->faker->domainName(),
            'famous' =>$this->faker->randomElement(['0', '1']),
            'hidden_gem' =>$this->faker->randomElement(['0', '1']),
            'dest_approval' =>$this->faker->randomElement(['Pending','Approved']),
            'dest_reasons' =>$this->faker->paragraph(),
            'dest_rating_average'=> '0'
        ];
    }
}
