<?php

namespace Database\Seeders;

use App\Models\DestinationActivity;
use Illuminate\Database\Seeder;

class DestinationActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $destination_activity= DestinationActivity::create([
            'destination_id' => 100001,
            'activity' => 'Kayaking',
            'activity_description' =>'A fun activity that allows you to move over water using a small boat named \'kayak\'.',
            'activity_number_of_pax' => '1',
            'activity_fee' => 'Php 75'
        ]);
        $destination_activity= DestinationActivity::create([
            'destination_id' => 100002,
            'activity' => 'Dragon Fruit Picking',
            'activity_description' =>'Experience harvesting a sweet-tasting dragon fruit',
            'activity_number_of_pax' => '1',
            'activity_fee' => 'Php 120 per kilo'
        ]);
        $destination_activity= DestinationActivity::create([
            'destination_id' => 100003,
            'activity' => 'Island Hopping',
            'activity_description' =>'An opportunity to visit the well-known Trinity Island in Oas.',
            'activity_number_of_pax' => '10',
            'activity_fee' => 'Php 1500'
        ]);
        $destination_activity= DestinationActivity::create([
            'destination_id' => 100003,
            'activity' => 'Farm and Hilltop Tour',
            'activity_description' =>'Be awed with nature\'s picturesque view',
            'activity_number_of_pax' => 'Any visitor',
            'activity_fee' => 'Free'
        ]);
        $destination_activity= DestinationActivity::create([
            'destination_id' => 100003,
            'activity' => 'Snorkeling',
            'activity_description' =>'See the beauty under the water.',
            'activity_number_of_pax' => '1',
            'activity_fee' => 'Free'
        ]);
        $destination_activity= DestinationActivity::create([
            'destination_id' => 100004,
            'activity' => 'Outside Dining',
            'activity_description' =>'Enjoy your food together with the fresh air and good ambiance of the place.',
            'activity_number_of_pax' => 'Any visitor',
            'activity_fee' => 'Free'
        ]);
        $destination_activity= DestinationActivity::create([
            'destination_id' => 100005,
            'activity' => 'Horseback Riding',
            'activity_description' =>'Try riding a horse now.',
            'activity_number_of_pax' => '1',
            'activity_fee' => 'Php 70'
        ]);
        $destination_activity= DestinationActivity::create([
            'destination_id' => 100005,
            'activity' => 'Biking',
            'activity_description' =>'Rent a bike and roam easily around the spacious park.',
            'activity_number_of_pax' => '1',
            'activity_fee' => 'Php 40 per 30 minutes'
        ]);
        $destination_activity= DestinationActivity::create([
            'destination_id' => 100005,
            'activity' => 'Boating',
            'activity_description' =>'Ride a boat and paddle around the park\'s large lagoon',
            'activity_number_of_pax' => '1',
            'activity_fee' => 'Php 50'
        ]);
        $destination_activity= DestinationActivity::create([
            'destination_id' => 100006,
            'activity' => 'Wall Climbing',
            'activity_description' =>'Work your muscles by climbing the man-made wall within the area.',
            'activity_number_of_pax' => '1',
            'activity_fee' => 'Php 50 per hour'
        ]);
        $destination_activity= DestinationActivity::create([
            'destination_id' => 100007,
            'activity' => 'Kite Flying',
            'activity_description' =>'Bring back your childhood memories as you fly a kite for free',
            'activity_number_of_pax' => 'Any visitor',
            'activity_fee' => 'Free'
        ]);
        $destination_activity= DestinationActivity::create([
            'destination_id' => 100007,
            'activity' => 'Bird Feeding',
            'activity_description' =>'Watch all the wonderful birds as you feed them',
            'activity_number_of_pax' => 'Any visitor',
            'activity_fee' => 'Free'
        ]);
        $destination_activity= DestinationActivity::create([
            'destination_id' => 100008,
            'activity' => 'Hiking',
            'activity_description' =>'Fullfill your adventure minded dream of hiking through a jungle to swim in a tropical lagoon in Busay Falls.m',
            'activity_number_of_pax' => 'Any visitor',
            'activity_fee' => 'Free'
        ]);
        $destination_activity= DestinationActivity::create([
            'destination_id' => 100009,
            'activity' => 'Indoor Exhibition',
            'activity_description' =>'The indoor exhibition includes four (4) permanent galleries with displays of botanical, zoological, and geological specimens that represent Bicol’s unique natural history. It features Bicol’s important geological structures and landforms, rocks, fossils, plants, and animals. The exhibition highlights the volcanoes of Bicol where students and guests can closely study how these mountains of lava were formed.  ',
            'activity_number_of_pax' => 'Any visitor',
            'activity_fee' => 'Free'
        ]);
        $destination_activity= DestinationActivity::create([
            'destination_id' => 100009,
            'activity' => 'Outdoor Exhibition',
            'activity_description' =>'The outdoor exhibition includes a garden of volcanic rocks, a butterfly garden, and a nursery of economically important plants in Bicol. A viewing deck is also available to view Mayon, a rare volcanic landform. The visitors will surely deepen their appreciation for nature especially with propagation activities at the butterfly garden.',
            'activity_number_of_pax' => 'Any visitor',
            'activity_fee' => 'Free'
        ]);
        $destination_activity= DestinationActivity::create([
            'destination_id' => 100010,
            'activity' => 'Camping',
            'activity_description' =>'Spend quality time with your friends and family through camping within the area. Stay for a night and be with the nature.',
            'activity_number_of_pax' => 'Any visitor',
            'activity_fee' => 'Free'
        ]);
        $destination_activity= DestinationActivity::create([
            'destination_id' => 100010,
            'activity' => 'Sunrise/Sunset Gazing',
            'activity_description' =>'The Campsite Mt. Masaraga is a great place for sunrise and sunset viewing. Indeed, it connects you more with the sky.',
            'activity_number_of_pax' => 'Any visitor',
            'activity_fee' => 'Free'
        ]);

    }
}
