<?php

namespace Database\Factories;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;

class DestinationActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $dest = Destination::pluck('id')->toArray();
        return [
            'destination_id' => $this->faker->randomElement($dest),
            'activity' =>$this->faker->name(),
            'activity_description' =>$this->faker->paragraph(3, true),
            'activity_number_of_pax' => rand(1,25),
            'activity_fee' => rand(50,500),
        ];
    }
}
