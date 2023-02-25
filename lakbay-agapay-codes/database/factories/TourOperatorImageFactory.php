<?php

namespace Database\Factories;

use App\Models\TourOperator;
use Illuminate\Database\Eloquent\Factories\Factory;

class TourOperatorImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $operator = TourOperator::pluck('id')->toArray();
        return [
            'tour_operator_id' => $this->faker->randomElement($operator),
            'operator_image' => "https://source.unsplash.com/random/500x500"
        ];
    }
}
