<?php

namespace Database\Seeders;

use App\Models\DestinationPackage;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DestinationPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $destination_package = DestinationPackage::create([
            'destination_id' => '100001',
            'dest_pkg_name' => 'Package 1 - Day Package',
            'dest_pkg_description' => ' Enjoy 8 Hours of Your Beach Trip Here in Punta Almara with Your Most Affordable Deal.',
            'dest_pkg_rate' => '3 Pax (Php 499 Per Pax)
2 Pax (Php 599 Per Pax)',
            'dest_pkg_min_fee' => 'Php 499',
            'dest_pkg_inclusions' => 'Enjoy:
    Fully Air-conditioned Cabana Room with Common Bathroom
    8-hour Access to Beach and Swimming Pool
    Provided with a Meal of Your Choice (Lunch/Dinner)',
        ]);

        $destination_package = DestinationPackage::create([
            'destination_id' => '100001',
            'dest_pkg_name' => 'Package 2 - Day and Night Package',
            'dest_pkg_description' => ' Enjoy 22 hours of your beach trip here in Punta Almara with your most affordable deal.',
            'dest_pkg_rate' => '4 Pax (Php 699 Per Pax)
3 Pax (Php 799 Per Pax)',
            'dest_pkg_min_fee' => 'Php 699',
            'dest_pkg_inclusions' => 'Enjoy:
    Fully Air-conditioned Villa Room Bathroom and Balcony
    22-hour Access to Beach and Swimming Pool
    Provided with Dinner and Breakfast',
        ]);

        $destination_package = DestinationPackage::create([
            'destination_id' => '100002',
            'dest_pkg_name' => 'Package 1 - Overnight Stay',
            'dest_pkg_description' => ' Come and enjoy a night under the stars here in JMP Adventure Park - Stairway to Heaven.',
            'dest_pkg_rate' => 'Php 1500 (Good for 2-4 Persons)',
            'dest_pkg_min_fee' => 'Php 1500',
            'dest_pkg_inclusions' => 'Cabana Cottage',
        ]);

        $destination_package = DestinationPackage::create([
            'destination_id' => '100003',
            'dest_pkg_name' => 'Package 1 - Day Tour Promo',
            'dest_pkg_description' => ' Breathe and be free. Visit Casa Mamita Farm and Beach Resort and enjoy our Day Tour Promo from 7 AM to 5 PM.',
            'dest_pkg_rate' => 'Php 1500 (Free Entrance for 10 Pax)
Php 100 Per Head for Additional Person',
            'dest_pkg_min_fee' => 'Php 1500',
            'dest_pkg_inclusions' =>
'Open Cottage
Pool Access
Farm and Hilltop Tour',
        ]);

        $destination_package = DestinationPackage::create([
            'destination_id' => '100003',
            'dest_pkg_name' => 'Package 2 - Barkada Promo',
            'dest_pkg_description' => ' Breathe and be free. Visit Casa Mamita Farm and Beach Resort and enjoy our Barkada Promo.',
            'dest_pkg_rate' => 'Php 799 Per Head (Minimum of 10 Pax to Avail)',
            'dest_pkg_min_fee' => 'Php 799',
            'dest_pkg_inclusions' =>
'Narra House
Videoke Use
Boodle Fight
Island Hopping
2 Pitchers Badian Sling
Pool Access
Hilltop Tour
Floating Kubo',
        ]);

        $destination_package = DestinationPackage::create([
            'destination_id' => '100003',
            'dest_pkg_name' => 'Package 3 - Happy Day Promo (Day Tour)',
            'dest_pkg_description' => ' Breathe and be free. Visit Casa Mamita Farm and Beach Resort and enjoy our Happy Day Promo.',
            'dest_pkg_rate' => 'Php 499 Per Head (Minimum of 6 Pax to Avail)',
            'dest_pkg_min_fee' => 'Php 499',
            'dest_pkg_inclusions' =>
'Island Hopping
Open Cottage
Hilltop Tour
Boodle Fight
Pool Access
Floating Kubo Access
Paragos Ride',
        ]);

        $destination_package = DestinationPackage::create([
            'destination_id' => '100003',
            'dest_pkg_name' => 'Package 4 - Promo 599',
            'dest_pkg_description' => ' Breathe and be free. Visit Casa Mamita Farm and Beach Resort and enjoy our Promo 599.',
            'dest_pkg_rate' => 'Php 599 Per Head (Minimum of 6 Pax to Avail)',
            'dest_pkg_min_fee' => 'Php 599',
            'dest_pkg_inclusions' =>
'Island Hopping
Accommodation
Pool Access
Hilltop Tour
Floating Kubo
Breakfast
Paragos Ride',
        ]);

        $destination_package = DestinationPackage::create([
            'destination_id' => '100003',
            'dest_pkg_name' => 'Package 5 - Chill Crew Promo',
            'dest_pkg_description' => ' Breathe and be free. Visit Casa Mamita Farm and Beach Resort and enjoy our Chill Crew Promo.',
            'dest_pkg_rate' => 'Php 499 Per Head (Minimum of 4 Pax to Avail)',
            'dest_pkg_min_fee' => 'Php 499',
            'dest_pkg_inclusions' =>
'Kubo House
Movie Night by the Beach
Bonfire
1 Pitcher Badian Sling
Pool Access
Floating Kubo Access
Hilltop Tour
Breakfast Picnic by the Beach
Snorkeling Gear use for an hour
Kayak Use for an Hour',
        ]);

        $destination_package = DestinationPackage::create([
            'destination_id' => '100003',
            'dest_pkg_name' => 'Package 6 - Love Treat Promo',
            'dest_pkg_description' => ' Breathe and be free. Visit Casa Mamita Farm and Beach Resort and enjoy our Love Treat Promo.',
            'dest_pkg_rate' => 'Php 1599',
            'dest_pkg_min_fee' => 'Php 1599',
            'dest_pkg_inclusions' =>
'Casitas Unit for 2 Pax
Dinner for 2
Pool Access
Floating Kubo Access
Hilltop Tour',
        ]);

        $destination_package = DestinationPackage::create([
            'destination_id' => '100003',
            'dest_pkg_name' => 'Package 7 - Party City Promo',
            'dest_pkg_description' => ' Breathe and be free. Visit Casa Mamita Farm and Beach Resort and enjoy our Party City Promo.',
            'dest_pkg_rate' => 'Php 25000 for 50 Pax',
            'dest_pkg_min_fee' => 'Php 25000',
            'dest_pkg_inclusions' =>
'Function Hall
Pavillon
Annex 1,2 and 3
Billiard Table
5 Pitchers Badian Sling
Pool Access
Hilltop Tour
Floating Kubo
Videoke',
        ]);

        $destination_package = DestinationPackage::create([
            'destination_id' => '100003',
            'dest_pkg_name' => 'Package 8 - Camper’s Delight',
            'dest_pkg_description' => ' Breathe and be free. Visit Casa Mamita Farm and Beach Resort and enjoy our Party City Promo.',
            'dest_pkg_rate' => 'Php 399 Per Head (Minimum of 2 Pax)',
            'dest_pkg_min_fee' => 'Php 399',
            'dest_pkg_inclusions' =>
'Camping Tent
Breakfast
Pool Access
Floating Kubo
Hilltop Tour',
        ]);

        $destination_package = DestinationPackage::create([
            'destination_id' => '100004',
            'dest_pkg_name' => 'Package 1',
            'dest_pkg_description' => ' Come and visit The Cube House and enjoy a relaxing night with our Overnight Promos from 7 PM to 8 AM.',
            'dest_pkg_rate' => 'Php 10000 for 12 Pax
Plus Php 500 per Additional Head
Free for 3 Years Old and Below
Plus Php 3000 Reservation Fee (Php 1000 Cancellation Fine)',
            'dest_pkg_min_fee' => 'Php 10000',
            'dest_pkg_inclusions' =>
'2 Private Rooms with Toilet and Bath (6 Persons Each Room)
Exclusive Swimming Pool
Sitting Area with Parasol
Outdoor Dining with Kitchen and Toilet/Shower
Parking for at least 3 cars',
        ]);

        $destination_package = DestinationPackage::create([
            'destination_id' => '100004',
            'dest_pkg_name' => 'Package 2',
            'dest_pkg_description' => ' Come and visit The Cube House and enjoy a relaxing night with our Overnight Promos from 7 PM to 8 AM.',
            'dest_pkg_rate' => 'Php 13000 for 16 Pax
Plus Php 500 per Additional Head
Free for 3 Years Old and Below
Plus Php 3000 Reservation Fee (Php 1000 Cancellation Fine)',
            'dest_pkg_min_fee' => 'Php 13000',
            'dest_pkg_inclusions' =>
'2 Private Rooms with Loft + Toilet and Bath (8 Persons Each Room)
Exclusive Swimming Pool
Sitting Area with Parasol
Outdoor Dining with Kitchen and Toilet/Shower
Parking for at least 3 cars',
        ]);

        $destination_package = DestinationPackage::create([
            'destination_id' => '100004',
            'dest_pkg_name' => 'Package 3',
            'dest_pkg_description' => ' Come and visit The Cube House and enjoy a relaxing night with our Overnight Promos from 7 PM to 8 AM.',
            'dest_pkg_rate' => 'Php 5000 for 4-5 Pax
Plus Php 3000 Reservation Fee (Php 1000 Cancellation Fine)',
            'dest_pkg_min_fee' => 'Php 5000',
            'dest_pkg_inclusions' =>
'1 Private Rooms with Toilet and Bath (5 Persons Each Room)
Shared Swimming Pool
Sitting Area with Parasol
Outdoor Dining with Kitchen and Toilet/Shower
Parking for at least 1 car',
        ]);

        $destination_package = DestinationPackage::create([
            'destination_id' => '100004',
            'dest_pkg_name' => 'Package 4',
            'dest_pkg_description' => ' Come and visit The Cube House and enjoy a relaxing night with our Overnight Promos from 7 PM to 8 AM.',
            'dest_pkg_rate' => 'Php 3500 for 2-3 Pax
Plus Php 3000 Reservation Fee (Php 1000 Cancellation Fine)',
            'dest_pkg_min_fee' => 'Php 3500',
            'dest_pkg_inclusions' =>
'1 Private Rooms with Toilet and Bath (5 Persons Each Room)
Shared Swimming Pool
Sitting Area with Parasol
Outdoor Dining with Kitchen and Toilet/Shower
Parking for at least 1 car',
        ]);

        $destination_package = DestinationPackage::create([
            'destination_id' => '100004',
            'dest_pkg_name' => 'Package 5',
            'dest_pkg_description' => ' Come and visit The Cube House and enjoy a relaxing day with our Daytime Promos from 9 AM to 5 PM.',
            'dest_pkg_rate' => 'Php 5000 for 12 Pax
Plus Php 250 per Additional Head
Free for 3 Years Old and Below
Plus Php 3000 Reservation Fee (Php 1000 Cancellation Fine)
Additional Php 1500 for Ordinary Room
Additional Php 2000 for Loft Type',
            'dest_pkg_min_fee' => 'Php 3500',
            'dest_pkg_inclusions' =>
'Shared Swimming Pool
Sitting Area with Parasol
Outdoor Dining with Kitchen and Toilet/Shower
Parking for at least 3 car',
        ]);

        $destination_package = DestinationPackage::create([
            'destination_id' => '100005',
            'dest_pkg_name' => 'Package 1',
            'dest_pkg_description' => ' Enjoy affordable deals while relaxing here in Albay Park and Wildlife.',
            'dest_pkg_rate' => 'Php 50 Per Head',
            'dest_pkg_min_fee' => 'Php 50',
            'dest_pkg_inclusions' => 'Access to:
    Picnic Groves
    Children’s playground
    Lagoon and Gazebo
    Senior Citizen’s groove
    Celebrity Groove
    Stage/Bleacher
    Comfort Rooms
    Animal Viewing',
        ]);

        $destination_package = DestinationPackage::create([
            'destination_id' => '100007',
            'dest_pkg_name' => 'Package 1',
            'dest_pkg_description' => ' Welcome to The Happiest Place in Bicol and enjoy a relaxing day filled with fun activities.',
            'dest_pkg_rate' => 'Php 60 per head for kids below 12 years old
Php 85 per head for adults',
            'dest_pkg_min_fee' => 'Php 60',
            'dest_pkg_inclusions' =>
'Full Farm Access
Free Use of Picnic Mats
Free Use of Playground
Free Bird Feeding
Free Bonfire every 6 PM to 7 PM
Free Use of Restrooms
Free Play of Kite
Free Spacious Parking Area',
        ]);

        $destination_package = DestinationPackage::create([
            'destination_id' => '100013',
            'dest_pkg_name' => 'Package 1',
            'dest_pkg_description' => 'Welcome to Batag Falls and enjoy 3 packages of cottages to choose to',
            'dest_pkg_rate' => 'Php 100 - Standard
Php 250 - Premium
Php 350 - Delux',
            'dest_pkg_min_fee' => 'Php 100',
            'dest_pkg_inclusions' => '',
        ]);

    }
}
