<?php

namespace Database\Factories;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;

class DestinationPackageFactory extends Factory
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
            'dest_pkg_name' =>$this->faker->name(),
            'dest_pkg_description' =>$this->faker->paragraph(3, true),
            'dest_pkg_rate' => rand(1,25),
            'dest_pkg_min_fee' => rand(500,2000),
            'dest_pkg_inclusions' =>$this->faker->paragraph($nbSentences = 4, $variableNbSentences = true),
        ];
    }
}
