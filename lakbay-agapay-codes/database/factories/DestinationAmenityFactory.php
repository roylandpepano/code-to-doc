<?php

namespace Database\Factories;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;

class DestinationAmenityFactory extends Factory
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
            'amenity' =>$this->faker->name(),
            'amenity_description' =>$this->faker->paragraph(3, true),
            'amenity_fee' => rand(50,500),
        ];
    }
}
