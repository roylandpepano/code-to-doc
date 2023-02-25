<?php

namespace Database\Factories;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;

class DestinationImageFactory extends Factory
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
            'dest_image' => "https://source.unsplash.com/random/500x500"
        ];
    }
}
