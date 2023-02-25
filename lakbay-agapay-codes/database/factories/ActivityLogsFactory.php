<?php

namespace Database\Factories;

use App\Models\Destination;
use App\Models\TourOperator;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityLogsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $number=rand(0,1);
        if($number % 2 == 0){
            return [
                'user_id' => rand(5,6),
                'destination_id' => Destination::inRandomOrder()->first()->id,
                'tour_operator_id' => null,
                'log_activity' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
                'log_action' => $this->faker->randomElement(['Approve','Reject','Remove','Restore','Edit','Add']),
            ];
        }else{
            return [
                'user_id' => rand(5, 6),
                'destination_id' => null,
                'tour_operator_id' =>TourOperator::inRandomOrder()->first()->id,
                'log_activity' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
                'log_action' => $this->faker->randomElement(['Approve','Reject','Remove','Restore','Edit','Add']),
            ];
        }
    }
}
