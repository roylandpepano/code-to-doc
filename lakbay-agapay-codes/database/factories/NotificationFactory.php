<?php

namespace Database\Factories;

use App\Models\Destination;
use App\Models\TourOperator;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
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
                'destination_id' => Destination::inRandomOrder()->first()->id,
                'tour_operator_id' => null,
                'notif_type' =>$this->faker->randomElement(['Message','Request']),
                'notif_message' =>$this->faker->paragraph(2, true),
                'notif_read' => rand(0,1),
            ];
        }else{
            return [
                'destination_id' => null,
                'tour_operator_id' => TourOperator::inRandomOrder()->first()->id,
                'notif_type' =>$this->faker->randomElement(['Message','Request']),
                'notif_message' =>$this->faker->paragraph(2, true),
                'notif_read' => rand(0,1),
            ];
        }
    }
}
