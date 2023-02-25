<?php

namespace Database\Seeders;

use App\Models\DestinationAmenity;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DestinationAmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100001',
            'amenity' => 'Amenity 1',
            'amenity_description' => 'Open Cottages. Great for Day Rate. Common Bathroom Only. Can Accommodate Up To 8 Pax. With Electric Socket. With Privacy Curtains.',
            'amenity_fee' => 'Day Rate - Php 400. Night Rate - Php 700.',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100001',
            'amenity' => 'Amenity 2',
            'amenity_description' => 'Cabana Rooms. Fully Air-conditioned Room. Common Bathroom Only. With Lamp Shade Side Table. Can Accommodate Up To 2-3 Pax',
            'amenity_fee' => 'Day Rate - Php 1000. Night Rate - Php 1500',
        ]);


        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100002',
            'amenity' => 'Amenity 1',
            'amenity_description' => 'Tents with Free Beddings.',
            'amenity_fee' => 'Small - Php 200 (2 Pax). Medium - Php 300 (3 Pax). Large - Php 500 (4-5 Pax).',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100002',
            'amenity' => 'Amenity 2',
            'amenity_description' => 'Cabanas with Free Beddings and Breakfast for Two.',
            'amenity_fee' => 'Php 1500',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100003',
            'amenity' => 'Amenity 1',
            'amenity_description' => 'Pavillon. 20-25 Pax (Free Entrance for 20 Pax)',
            'amenity_fee' => 'Php 8000',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100003',
            'amenity' => 'Amenity 2',
            'amenity_description' => 'Mahogany. 10-15 Pax (Free Entrance for 10 Pax)',
            'amenity_fee' => 'Php 6000',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100003',
            'amenity' => 'Amenity 3',
            'amenity_description' => 'Narra. 10-12 Pax (Free Entrance for 10 Pax)',
            'amenity_fee' => 'Php 4000',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100004',
            'amenity' => 'Amenity 1',
            'amenity_description' => 'Dining/Kitchen Area with Internet Access',
            'amenity_fee' => '',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100004',
            'amenity' => 'Amenity 2',
            'amenity_description' => 'Swimming Pool for Adults and Kids.',
            'amenity_fee' => '',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100005',
            'amenity' => 'Amenity 1',
            'amenity_description' => 'Food Court',
            'amenity_fee' => '',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100005',
            'amenity' => 'Amenity 2',
            'amenity_description' => 'Picnic Grove',
            'amenity_fee' => '',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100005',
            'amenity' => 'Amenity 3',
            'amenity_description' => 'Children’s Playground',
            'amenity_fee' => '',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100005',
            'amenity' => 'Amenity 4',
            'amenity_description' => 'Special Gazebo',
            'amenity_fee' => '',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100005',
            'amenity' => 'Amenity 5' ,
            'amenity_description' => 'Senior Citizen’s Groove',
            'amenity_fee' => '',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100006',
            'amenity' => 'Amenity 1 ' ,
            'amenity_description' => 'Restaurant',
            'amenity_fee' => '',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100007',
            'amenity' => 'Amenity 1' ,
            'amenity_description' => 'Campsite. Full Farm Access. Free Use of Picnic Mats. Free Use of Playground.',
            'amenity_fee' => 'Free',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100007',
            'amenity' => 'Amenity 2',
            'amenity_description' => 'Banyo na Bato. Free Use of Restrooms.',
            'amenity_fee' => 'Free',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100007',
            'amenity' => 'Amenity 3' ,
            'amenity_description' => 'Open Cottages',
            'amenity_fee' => 'Free',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100008',
            'amenity' => 'Amenity 1' ,
            'amenity_description' => 'Cottages',
            'amenity_fee' => 'Php 200',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100008',
            'amenity' => 'Amenity 2' ,
            'amenity_description' => 'Comfort Rooms and Shower Rooms',
            'amenity_fee' => 'Free',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100009',
            'amenity' => 'Amenity 1' ,
            'amenity_description' => 'Four Permanent Galleries with Displays of Botanical, Zoological and Geological Specimens',
            'amenity_fee' => 'Free',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100009',
            'amenity' => 'Amenity 2' ,
            'amenity_description' => 'Garden of Volcanic Rocks',
            'amenity_fee' => 'Free',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100009',
            'amenity' => 'Amenity 3' ,
            'amenity_description' => 'A Butterfly Garden',
            'amenity_fee' => 'Free',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100009',
            'amenity' => 'Amenity 4' ,
            'amenity_description' => 'Nursery of Economically Important Plants in Bicol',
            'amenity_fee' => 'Free',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100009',
            'amenity' => 'Amenity 5' ,
            'amenity_description' => 'Viewing Deck',
            'amenity_fee' => 'Free',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100010',
            'amenity' => 'Amenity 1' ,
            'amenity_description' => 'Cottage with Camping Mats',
            'amenity_fee' => 'Php 500',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100010',
            'amenity' => 'Amenity 2' ,
            'amenity_description' => 'Guest House',
            'amenity_fee' => 'Php 1500',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100010',
            'amenity' => 'Amenity 3' ,
            'amenity_description' => 'Campsite Cabin',
            'amenity_fee' => 'Php 2000',
        ]);

        $destination_amenity = DestinationAmenity::create([
            'destination_id' => '100010',
            'amenity' => 'Amenity 4' ,
            'amenity_description' => 'Santigwaran',
            'amenity_fee' => 'Php 2500',
        ]);
    }
}
