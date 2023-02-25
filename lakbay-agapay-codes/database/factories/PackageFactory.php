<?php

namespace Database\Factories;

use App\Models\TourOperator;
use Illuminate\Database\Eloquent\Factories\Factory;

class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $to = TourOperator::pluck('id')->toArray();
        return [
            'tour_operator_id' => TourOperator::inRandomOrder()->first()->id,
            'package_name' =>$this->faker->name(),
            'package_description' =>$this->faker->paragraph(3, true),
            'package_number_of_pax' => rand(1,25),
            'package_fee' => rand(500,2000),
            'package_inclusions' =>$this->faker->paragraph($nbSentences = 4, $variableNbSentences = true),
            'package_itinerary' =>$this->faker->paragraph($nbSentences = 8, $variableNbSentences = true),
        ];
    }
}
