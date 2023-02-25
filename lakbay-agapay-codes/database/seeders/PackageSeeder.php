<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $package = Package::create([
            'tour_operator_id' => '200001',
            'package_name' => 'Half Day Eco Adventure Tour with Hoyop-hoyopan Cave',
            'package_description' => '  Want to go on spelunking while in Albay? Visit our favorite Hoyop-hoyopan cave which is mostly made of limestone. This was also a place of refuge by the locals during the Japanese time and was also used as a dance hall during the Martial Law period when locals celebrate festive occasions like Fiestas. Be awestruck as we go sight-seeing in Quituinan Hills, a favorite place to see Mayon Volcano. Explore Solong Ecopark as well as the breath taking view in Sumlang Lake where you can enjoy nature at its best.',
            'package_rate' =>
'12 pax (699 PHP/pax)
11 pax (749 PHP/pax)
10 pax (799 PHP/pax)
9 pax (849 PHP/pax)
8 pax (949 PHP/pax)
7 pax (1049 PHP/pax)
6 pax (1199 PHP/pax)
5 pax (1399 PHP/pax)
4 pax (1699 PHP/pax)
3 pax (2299 PHP/pax)
2 pax (3399 PHP/pax)',
            'package_minimum_fee' => '699',
            'package_inclusions' =>
'Visit the ff:
    Hoyop-hoyopan Cave
    Quituinan Hills
    Solong Eco-Park
    Solong Bee Farm
    Solong Cave
    Sumlang Lake
    Souvenir Shopping
Exclusive use of DOT Accredited Air-conditioned Van
All Entrance and Environmental Fees
1 Tour Facilitator
1 Bottled Water per guest
Full Coordination)',
            'package_itinerary' => 'Tour Duration: 4 hours (Morning – 8:00AM – 12:00NN; Afternoon – 1:00PM – 5:00PM); excess hour will be at PHP300.00/hour for the whole group'
        ]);
        $package = Package::create([
            'tour_operator_id' => '200001',
            'package_name' => '1 Day Albay Provincial 360 Tour',
            'package_description' => '  Albay is one of the 6 provinces of the Bicol Region. Its capital is Legazpi City, dubbed as the “City of Fun and Adventure”. It is located at the southern part of Luzon, and only 45 minutes direct flight from Manila. This is our best seller tour wherein you can go around the Province of Albay 360 degrees and see the majestic and beautiful Mayon Volcano, renowned for its perfect cone. Along with the famed Cagsawa Ruins, take a trip around Albay to see equally breathtaking tourist destinations including Sumlang Lake and the Mayon Skyline. Sumlang Lake will capture you with its serenity and calm waters, and Mayon Skyline will rock your experience leaving you stunned by the fantastic view of the perfect cone-shaped Mayon Volcano. It’s just what you need for your next trip!',
            'package_rate' =>
'12 pax (999 PHP/pax)
11 pax (1099 PHP/pax)
10 pax (1199 PHP/pax)
9 pax (1299 PHP/pax)
8 pax (1399 PHP/pax)
7 pax (1599 PHP/pax)
6 pax (1799 PHP/pax)
5 pax (2199 PHP/pax)
4 pax (2499 PHP/pax)
3 pax (3299 PHP/pax)
2 pax (4899 PHP/pax)',
            'package_minimum_fee' => '999',
            'package_inclusions' =>
'1 Day Albay Provincial Tour
    Legazpi Boulevard
    Lignon Hill
    Daraga Church
    Cagsawa Church
    Sumlang Lake
    Kawa-Kawa Hill
    Mayon Skyline
    Souvenir Shopping
Exclusive use of DOT Accredited Air-conditioned Van
All Entrance and Environmental Fees
1 Tour Facilitator
1 Bottled Water per guest
Full Coordination',
           'package_itinerary' => 'Tour Duration: 8-9 hours (8:00AM – 5:00PM); excess hour will be at PHP300.00/hour for the whole group'
        ]);
        $package = Package::create([
            'tour_operator_id' => '200001',
            'package_name' => '3 Days/ 2 Nights Amazing Albay with 1 Day Albay Provincial Tour with Vera Falls',
            'package_description' =>
'   It’s time to explore Bicolandia’s best assets! Your vacation time is for relaxation, so that is what you need to do! Lucky for you, this package will bring you to Albay destinations that will truly calm you.
    If you avail this package, you can stay at quality accommodations here in Albay. You will also get the chance to enjoy and relax in the very cool and bluish waters of Vera Falls, and have an adventure to Busay Falls aside from touring around Legazpi City. And of course, souvenir shopping is also on our itinerary!',
            'package_rate' =>
'12 pax
    Emerald Boutique Hotel (3199 PHP/pax)
    Proxy by The Oriental Hotel (3699 PHP /pax)
    The Marison Hotel (6899 PHP/pax)
11 pax
    Emerald Boutique Hotel (3299 PHP/pax)
    Proxy by The Oriental Hotel (3799 PHP /pax)
    The Marison Hotel (6999 PHP/pax)
10 pax
    Emerald Boutique Hotel (3299 PHP/pax)
    Proxy by The Oriental Hotel (3799 PHP /pax)
    The Marison Hotel (6999 PHP/pax)
9 pax
    Emerald Boutique Hotel (3499 PHP/pax)
    Proxy by The Oriental Hotel (3999 PHP /pax)
    The Marison Hotel (6799 PHP/pax)
8 pax
    Emerald Boutique Hotel (3599 PHP/pax)
    Proxy by The Oriental Hotel (4099 PHP /pax)
    The Marison Hotel (7199 PHP/pax)
7 pax
    Emerald Boutique Hotel (3799 PHP/pax)
    Proxy by The Oriental Hotel (4199 PHP /pax)
    The Marison Hotel (6999 PHP/pax)
6 pax
    Emerald Boutique Hotel (3999 PHP/pax)
    Proxy by The Oriental Hotel (4499 PHP /pax)
    The Marison Hotel (7599 PHP/pax)
5 pax
    Emerald Boutique Hotel (4299 PHP/pax)
    Proxy by The Oriental Hotel (4699 PHP /pax)
    The Marison Hotel (7299 PHP/pax)
4 pax
    Emerald Boutique Hotel (4799 PHP/pax)
    Proxy by The Oriental Hotel (5299 PHP /pax)
    The Marison Hotel (8299 PHP/pax)
3 pax
    Emerald Boutique Hotel (5599 PHP/pax)
    Proxy by The Oriental Hotel (5899 PHP /pax)
    The Marison Hotel (7999 PHP/pax)
2 pax
    Emerald Boutique Hotel (7199 PHP/pax)
    Proxy by The Oriental Hotel (7699 PHP /pax)
    The Marison Hotel (10499 PHP/pax)',
            'package_minimum_fee' => '3199',
            'package_inclusions' =>
'3 Days/2 Nights Standard Room Hotel Accommodation
 Daily Breakfast
 Roundtrip Airport Transfers
 1 Day Albay Provincial Tour
    2nd Day
        Swimming at Vera Falls
        Swimming at Busay Falls
        Legazpi Boulevard
        Lignon Hill (Daraga Albay)
        Cagsawa Church (Daraga Albay)
        Souvenir Shopping;
Exclusive use of DOT Accredited Air-conditioned Van
All Entrance and Environmental Fees
1 Tour Facilitator
1 Bottled Water per guest
Full Coordination',
            'package_itinerary' =>
'DAY 1
    Guest Arrival in Legazpi City
    Check-in at Hotel
    Optional Tour in the Afternoon:
        ATV Ride to Mayon Lava
            a. PHP1,500/pax for GREEN LAVA
            b.  PHP1,850/pax for BLACK LAVA
 DAY 2
    1 Day ALBAY Tour with Vera Falls (SCHEDULE: 8:00 AM- 5:00 PM)
 DAY 3
    Check-out from Hotel
    Transfer from Hotel to Legazpi City Airport
    Depart for Manila'
            ]);
        $package = Package::create([
            'tour_operator_id' => '200001',
            'package_name' => '1 Day Albay Tour with Vera Falls and Busay Falls Adventure',
            'package_description' =>
'   Enjoy our 1 day Albay Tour with the Vera Falls and Busay Falls as the highlight of the tour. Relax and swim in these falls, where the water is fresh and cold and experience nature at its best. Hidden yet constantly sought, Vera Falls and Busay Falls are waiting for you.
    Added attraction is a visit to the Tiwi Pottery in Tiwi Albay where you can see the terracotta ceramic jars that is proudly made by the locals of Tiwi Albay.',
            'package_rate' =>
'12 pax (899 PHP/pax)
11 pax (949 PHP/pax)
10 pax (999 PHP/pax)
9 pax (1099 PHP/pax)
8 pax (1199 PHP/pax)
7 pax (1399 PHP/pax)
6 pax (1599 PHP/pax)
5 pax (1899 PHP/pax)
4 pax (2299 PHP/pax)
3 pax (2999 PHP/pax)
2 pax (4499 PHP/pax)',
            'package_minimum_fee' => '899',
            'package_inclusions' =>
'Visit the ff:
    Legazpi Boulevard
    Lignon Hill
    Daraga Church
    Cagsawa Church
    Swimming at Vera Falls
    Swimming at Busay Falls
    Tiwi Pottery
    Souvenir Shopping
Exclusive use of One Air-conditioned Van
All Entrance and Environmental Fees
1 Tour Facilitator
1 Bottled Water per guest
Full Coordination)',
            'package_itinerary' => 'Tour Duration: 8-9 hours (8:00AM – 5:00PM)'
        ]);
        $package = Package::create([
            'tour_operator_id' => '200001',
            'package_name' => 'Half Day Legazpi City Tour',
            'package_description' =>
'   You don’t have to get out of the urban streets to have the vacation you need. Even with a limited time and budget, you can still get the perfect tour package! Enjoy our half day tour and take a trip around Daraga and Legazpi City’s most popular destinations. See the expanse of the city atop Lignon Hill, feel the sea breeze at Legazpi City and witness the beauty of Mayon Volcano at the Cagsawa Ruins.
    Enjoy all the sights that truly define the heart of Albay, and still have the time to go souvenir shopping.',
            'package_rate' =>
'12 pax (649 PHP/pax)
11 pax (699 PHP/pax)
10 pax (749 PHP/pax)
9 pax (799 PHP/pax)
8 pax (899 PHP/pax)
7 pax (999 PHP/pax)
6 pax (1099 PHP/pax)
5 pax (1299 PHP/pax)
4 pax (1599 PHP/pax)
3 pax (1999 PHP/pax)
2 pax (2899 PHP/pax)',
            'package_minimum_fee' => '649',
            'package_inclusions' =>
'Half day Legazpi Tour
    Legazpi Boulevard
    Daraga Church
    Lignon Hill
    Sumlang Lake
    Cagsawa Church
    Souvenir Shopping
    Rolling Tour to Headless Monument
    Embarcadero
    Legazpi Trylon
    Legazpi City Business District
    Albay Provincial Capitol
    Legazpi City Hall
    Penaranda Park
    Camp Simeon Ola
Exclusive use of One Air-conditioned Van
All Entrance and Environmental Fees
1 Tour Facilitator
1 Bottled Water per guest
Full Coordination',
            'package_itinerary' => 'Tour Duration: 4 hours (Morning – 8:00AM – 12:00NN; Afternoon – 1:00PM – 5:00PM); excess hour will be at PHP300.00/hour for the whole group'
        ]);
        $package = Package::create([
            'tour_operator_id' => '200002',
            'package_name' => 'Experience Coron',
            'package_description' => '  Hit all the must-see Coron Island attractions in this tour! Includes the highlights that serve as the prime examples of why Palawan has been consistently voted as one of the best islands in the world.',
            'package_rate' => '3299',
            'package_minimum_fee' => '649',
            'package_inclusions' =>
'Hotel
RT Airport Transfer
Tour A',
            'package_itinerary' => 'Tour Duration: 4 hours (Morning – 8:00AM – 12:00NN; Afternoon – 1:00PM – 5:00PM); excess hour will be at PHP300.00/hour for the whole group'
        ]);
        $package = Package::create([
            'tour_operator_id' => '200002',
            'package_name' => 'EL NIDO PACKAGE TOUR',
            'package_description' =>
'EL NIDO PALAWAN
    - known for its stunning lagoons, white sand beaches,rockey islets,&towering limestone cliff.',
            'package_rate' => '--',
            'package_minimum_fee' => '--',
            'package_inclusions' =>
'3D/2N budget AC accommodation
Complimentary set breakfast
SIC RT van transfer (PPS - El Nido terminal - PPS)
SIC Island hopping tour a
Services of a licensed tour guide
Boat transfer
Use of life jacket
Picnic lunch in island hopping
Travel insurance',
            'package_itinerary' =>
'DAY 1: Pick up at PPS/transfer to El Nido terminal
DAY 2: Island hopping
DAY 3: Transfer to PPS airport

 Note: Van transfer not allowed to pick up and drop-off the guest inside the town of El Nido - drop off and pick up is in El Nido terminal only.'
        ]);
        $package = Package::create([
            'tour_operator_id' => '200002',
            'package_name' => 'PUERTO PRINCESA PACKAGE TOUR',
            'package_description' =>
'   Puerto Princesa is the greatest option if you consider yourself a true urbanite who enjoys day trips into nature but yet wants to be close to all the conveniences of the city.',
            'package_rate' => '--',
            'package_minimum_fee' => '--',
            'package_inclusions' =>
'3D/2N budget AC accommodation
Complimentary set breakfast
Complimentary airport transfer with scheduled time
SIC Puerto Princesa City tour
Services of a licensed tour guide
Travel insurance
Entrance fee
Light snacks',
            'package_itinerary' =>
'DAY 1: Pick up at PPS airport
DAY 2: City tour
DAY 3: Transfer to PPS airport'
       ]);
        $package = Package::create([
            'tour_operator_id' => '200004',
            'package_name' => 'Majestic Albay Package A',
            'package_description' => '',
            'package_rate' =>
'10 PAX – Php 1,199.00/pax
9 PAX – Php 1,249.00/pax
8 PAX – Php 1,324.00/pax
7 PAX – Php 1,415.00/pax
6 PAX – Php 1,549.00/pax
5 PAX – Php 1,713.00/pax
4 PAX – Php 1,974.00/pax',
            'package_minimum_fee' => '1199',
            'package_inclusions' =>
'Air – conditioned tourist transport service (depends on no. of pax; van if 4 pax up;sedan 3 pax below)
DOT Trained Tour Guide Services
FREE unlimited cold bottled water
Driver, fuel & taxes
Entrance fees & permits
Light Snacks PM snacks',
            'package_itinerary' =>
'Lignon Hills
Japanese Tunnel
Daraga Church
Cagsawa Ruins
Hoyop – hoyopan Cave
St. John the Baptist Church – Tabaco City
Mayon Skyline
Legazpi Boulevard
Souvenir Shopping
Rolling Tour:
    Legazpi City Port District
    Old Albay District
    Tabaco City
    etc.'
       ]);
        $package = Package::create([
            'tour_operator_id' => '200004',
            'package_name' => 'Majestic Albay Package B',
            'package_description' => '',
            'package_rate' =>
'10 PAX – Php 1,255.00/pax
9 PAX – Php 1,314.00/pax
8 PAX – Php 1,387.00/pax
7 PAX – Php 1,481.00/pax
6 PAX – Php 1,609.00/pax
5 PAX – Php 1,789.00/pax
4 PAX – Php 2,049.00/pax',
            'package_minimum_fee' => '1255',
            'package_inclusions' =>
'Air – conditioned tourist transport service (depends on no. of pax; van if 4 pax up;sedan 3 pax below)
DOT Trained Tour Guide Services
FREE unlimited cold bottled water
Driver, fuel & taxes
Entrance fees & permits
Light Snacks PM snacks',
            'package_itinerary' =>
'Lignon Hills
Japanese Tunnel
Daraga Church
Cagsawa Ruins
Hoyop – hoyopan Cave
Sumlang Lake
Quitinday Green Hills
Legazpi Boulevard
Souvenir Shopping
Rolling Tour:
    Legazpi City Port District
    Old Albay District
    Tabaco City
    etc.'
        ]);
        $package = Package::create([
            'tour_operator_id' => '200004',
            'package_name' => '3d/2n Albay + Sorsogon Countryside Tour',
            'package_description' => '',
            'package_rate' =>
'10 PAX – Php 4,059.00/pax
9 PAX – Php 4,219.00/pax
8 PAX – Php 4,429.00/pax
7 PAX – Php 4,979.00/pax
6 PAX – Php 4,979.00/pax
5 PAX – Php 5,749.00/pax
4 PAX – Php 6,729.00/pax
3 PAX - Php 7,969.00/pax
2 PAX - Php 10,649.00/pax',
            'package_minimum_fee' => '4059',
            'package_inclusions' =>
'2 Nights Budget Hotel Accommodation
DOT Accredited Service Van
Permits & Entrance Fees (Day 1 & 2 Tour)
Complimentary Water
Albay Tour
Sorsogon with Buhatan River Cruise Buffet
Driver
Fuel
Taxes
Tour Guide',
            'package_itinerary' =>
'Albay:
    Lignon Hills
    Japanese Tunnel
    Cagsawa Ruins
    Hoyop-hoyopan Cave
    Padang Shrine
    Legazpi Boulevard
    The Obelisk
    Souvenir Shopping
    Rolling Tour:
        Legazpi City Hall
        Provincial Capitol
        Peñaranda Park
        Peñaranda Monument
        Albay Cathedral
        Bicol University
        Headless Monument
        Legazpi Thrylon
        Legazpi City Business Center
Sorsogon:
    Sorsogon City Rolling Tour:
        Municipal Hall of Sorsogon
        Chiz Escudero’s Home
        Pepita Park & Rest Area
        Juban Colonial Houses
        Bulusan Lake
        Balay Buhay Sa Uma Bee Farm
        Buhatan River Cruise'
        ]);
        $package = Package::create([
            'tour_operator_id' => '200004',
            'package_name' => '3d/2n Countryside Catanduanes',
            'package_description' => '',
            'package_rate' =>
'10 PAX – Php 4,059.00/pax
8 PAX – Php 3,099.00/pax
7 PAX – Php 3,299.00/pax
6 PAX – Php 3,399.00/pax
5 PAX – Php 3,799.00/pax
4 PAX – Php 4,399.00/pax
3 PAX - Php 4,499.00/pax
2 PAX - Php 6,299.00/pax',
            'package_minimum_fee' => '3099',
            'package_inclusions' =>
'2 Nights Budget Hotel Accommodation
Roundtrip airport/port transfers
Air-conditioned tourist van service
Day 1 East Tour
Day 2 West Tour
Tour Guide',
            'package_itinerary' =>
'WEST CATANDUANES DAY TOUR
    Museo de Catanduanes
    Virac Cathedral
    Luyang Cave
    Batong Paloway
    Mamangal Beach
    Batag Beach
    Talisoy Beach
    Twin Rock Beach & Resort
EAST CATANDUANES DAY TOUR
    Maribina Falls
    Bato Church
    Pag-asa Weather Radar Station
    Puraran Beach
    Balacay Point
    Binurong Point'
        ]);
        $package = Package::create([
            'tour_operator_id' => '200004',
            'package_name' => 'Albay Tour with Vera Falls',
            'package_description' => '',
            'package_rate' =>
'12 PAX - Php 1,259.00/pax
10 PAX – Php 1,319.00/pax
9 PAX – Php 1,389.00/pax
8 PAX – Php 1,469.00/pax
7 PAX – Php 1,589.00/pax
6 PAX – Php 1,649.00/pax
5 PAX – Php 1,939.00/pax
4 PAX – Php 2,249.00/pax',
            'package_minimum_fee' => '1259',
            'package_inclusions' =>
'Air – conditioned tourist transport service
DOT Trained Tour Guide Services
FREE Unlimited cold bottled water
Driver, fuel & taxes
Entrance fees & permits
Cottage Rentals
Boat guide and boat man
Fuel, taxes & entrance fees
Picnic Lunch',
            'package_itinerary' =>
'AM – Vera Falls
Mayon Skyline
St. John the Baptist Church
Tabaco City
Tabaco City Hall
Lignon Hills
Legazpi Boulevard
Padang Shrine
Legazpi City Rolling Tour:
    Legazpi Port District & Old Albay District'
        ]);
        $package = Package::create([
            'tour_operator_id' => '200004',
            'package_name' => 'Albay\'s Finest Sparkling Island Adventure',
            'package_description' => '',
            'package_rate' =>
'12 PAX - Php 1,999.00/pax
10 PAX – Php 2,099.00/pax
9 PAX – Php 2,199.00/pax
8 PAX – Php 2,369.00/pax
7 PAX – Php 2,580.00/pax
6 PAX – Php 2,865.00/pax
5 PAX – Php 3,261.00/pax
4 PAX – Php 3,859.00/pax',
            'package_minimum_fee' => '1999',
            'package_inclusions' =>
'Air – conditioned tourist transport service (depends on no. of pax; van if 4 pax up;sedan 3 pax below)
DOT Trained Tour Guide Services
FREE Unlimited cold bottled water
Driver, fuel & taxes
Entrance Fees & permits
Cottage Rentals
Boat guide and boat man
Fuel, taxes & entrance fees
Picnic Lunch',
            'package_itinerary' =>
'Guinanayan Island
Cabungahan Island
Pinamuntugan Island
Cagraray Eco Park
Optional:
    Vanishing Island'
        ]);
        $package = Package::create([
            'tour_operator_id' => '200005',
            'package_name' => 'One Day Exciting Daraga-Legazpi tour',
            'package_description' => '  Explore the several wonders in Daraga and Legazpi Cty as we roam around for one day.',
            'package_rate' =>
'2 pax - Php 3470/pax
4 pax - Php 2310/pax
6 pax - Php 1999/pax
8 pax - Php 1750/pax
10 pax - Php 1599/pax',
            'package_minimum_fee' => '1599',
            'package_inclusions' =>
                'Aircon transportation
DOT accredited Tour Guide
All permit and entrances
Complimentary bottled water
Full coordination',
            'package_itinerary' =>
                'Legazpi Boulevard
Legazpin Rolling Tour
Legazpi City Museum
Daraga Church
National Museum
Cagsawa Ruins
OLS giant Statue'
        ]);
        $package = Package::create([
            'tour_operator_id' => '200005',
            'package_name' => 'Albay 3 Days and 2 Nights',
            'package_description' => '  Visit the several wonders of Albay together with our team.',
            'package_rate' => 'Php 8,700 ,minimum 2 persons',
            'package_minimum_fee' => '8700',
            'package_inclusions' =>
'3days 2nights at Alta Suites or similar class
Roundtrip Legazpi Airport Transfer
Daily hotel set/buffet breakfast
Local DOT tour guide service
Private aircon van for tour transfer
Lunch at Red Labuyo Restaurant or similar resto on Day 2
A choice of sightseeing tours:
    Option 1:
        Legazpi City Tour
            (10hrs) to visit Cagsawa Ruins, Lignon Hills, Japanese Tunnel, Daraga Church, Sumlang Lake, Embarcadero Boulevard and Sleeping Lion
    Option 2:
        Countryside Tour
            (10hrs) to visit Kawa-Kawa Shrine, Hoyp Hoyopan Cave, Mayon Skyline, Tiwi Ceramic Plants, Busay or Vera Falls',
            'package_itinerary' => '--'
        ]);
        $package = Package::create([
            'tour_operator_id' => '200006',
            'package_name' => 'Day Tour Subic Matnog Island Hopping',
            'package_description' => '  Explore the beauty of Subic Matnog and experience exciting activities.',
            'package_rate' => '18 pax - 2,599 PHP/pax',
            'package_minimum_fee' => '2599',
            'package_inclusions' =>
'Van transportation Tabaco to Matnog v.v.
Boat rental
Registration fee
Entrance fee
Fish feeding fee
Open cottege
Lunch (boodle)
1L bottled water/pax',
            'package_itinerary' => '--'
        ]);
        $package = Package::create([
            'tour_operator_id' => '200006',
            'package_name' => 'Shangri-la Boracay',
            'package_description' => '  Shangri-la Boracay is a place where you have the peace and solitude takes your breath away. Come and visit it for 3 days and 2 nights',
            'package_rate' => '28888 Php for 2 pax',
            'package_minimum_fee' => '28888',
            'package_inclusions' =>
'Van transportation Tabaco to Matnog v.v.
Boat rental
Registration fee
Entrance fee
Fish feeding fee
Open cottege
Lunch (boodle)
1L bottled water/pax',
            'package_itinerary' => '--'
        ]);
        $package = Package::create([
            'tour_operator_id' => '200007',
            'package_name' => '1 Day Camalig and Daraga Tour',
            'package_description' => '  Enjoy historical places and natural wonders around Camalig and Daraga',
            'package_rate' =>
'2 pax - Php 4280/pax
4 pax - Php 2720/pax
6 pax - Php 1860/pax
8 pax - Php 1530/pax
10 pax - Php 1340//pax',
            'package_minimum_fee' => '1340',
            'package_inclusions' =>
'Aircon transportation
DOT accredited Tour Guide
All permit and entrances
Complimentary bottled water
Full coordination',
            'package_itinerary' =>
'Daraga Church
Cagsawa Ruins
National Museum - Bicol
Sumlang Lake
Camalig Rolling Tour
Quitwinan Hill
Hoyop-hoyopan Cave
Solong-Eco Park
Farm Plate',
        ]);
        $package = Package::create([
            'tour_operator_id' => '200007',
            'package_name' => 'Half Day Exciting Camalig Adventour',
            'package_description' => 'Cave - Hills - Lake',
            'package_rate' => '2 pax - Php 1800/pax
4 pax - Php 1220/pax
6 pax - Php 900/pax
8 pax - Php 740/pax
10 pax - Php 580/pax',
            'package_minimum_fee' => '580',
            'package_inclusions' =>
                'Aircon transportation
DOT accredited Tour Guide
All permit and entrances
Complimentary bottled water
Full coordination',
            'package_itinerary' =>
                'Hoyop-hoyopan Cave
Solong-Eco Park
Quitinday Hills
Quitwinan Ranch
Camalig Rolling Tour
Sumlang Lake'
        ]);
        $package = Package::create([
            'tour_operator_id' => '200008',
            'package_name' => '1 Day Exciting CADALE',
            'package_description' => '  One day cultural and eco tour in the area of Camalig, Daraga, and Legazpi',
            'package_rate' =>
'2 pax - Php 4260/pax
4 pax - Php 2700/pax
6 pax - Php 1840/pax
8 pax - Php 1510/pax
10 pax - Php 1320//pax',
            'package_minimum_fee' => '1320',
            'package_inclusions' =>
'Aircon transportation
DOT accredited Tour Guide
All permit and entrances
Complimentary bottled water
Full coordination',
            'package_itinerary' =>
'Legazpi Boulevard
Legazpi Rolling
Legazpi City Museum
Daraga Church
Cagsawa Ruins
National Museum - Bicol
Sumlang Lake
Camalig Rolling Tour
Quitwinan Hill
Hoyop-hoyopan Cave
Solong-Eco Park
Farm Plate',
        ]);
        $package = Package::create([
            'tour_operator_id' => '200008',
            'package_name' => 'Halfday Exciting DALE tour',
            'package_description' => 'A tour around Daraga and Legazpi CIty',
            'package_rate' =>
'2 pax - Php 2470/pax
4 pax - Php 1310/pax
6 pax - Php 999/pax
8 pax - Php 750/pax
10 pax - Php 599/pax',
            'package_minimum_fee' => '599',
            'package_inclusions' =>
'Aircon transportation
DOT accredited Tour Guide
All permit and entrances
Complimentary bottled water
Full coordination',
            'package_itinerary' =>
'Legazpi Boulevard
Legazpin Rolling Tour
Legazpi City Museum
Daraga Church
National Museum
Cagsawa Ruins
OLS giant Statue'
        ]);
        $package = Package::create([
            'tour_operator_id' => '200008',
            'package_name' => '1 Day Exciting Camalig Adventour',
            'package_description' => 'Cave - Hills - Lake',
            'package_rate' =>
'2 pax - Php 3600/pax
4 pax - Php 2440/pax
6 pax - Php 1649/pax
8 pax - Php 1480/pax
10 pax - Php 1160/pax',
            'package_minimum_fee' => '1160',
            'package_inclusions' =>
'Aircon transportation
DOT accredited Tour Guide
All permit and entrances
Complimentary bottled water
Full coordination',
            'package_itinerary' =>
                'Hoyop-hoyopan Cave
Solong-Eco Park
Quitinday Hills
Quitwinan Ranch
Camalig Rolling Tour
Sumlang Lake'
        ]);
        $package = Package::create([
            'tour_operator_id' => '200008',
            'package_name' => '1 Day Exciting Sorsogon Tour',
            'package_description' => '',
            'package_rate' =>
'10 pax - Php 1380/pax
8 pax - Php 1680/pax
6 pax - Php 2030/pax
4 pax - Php 2725/pax
2 pax - Php 4780/pax',
            'package_minimum_fee' => '1380',
            'package_inclusions' =>
'Aircon transportation
DOT accredited Tour Guide
All permit and entrances
Complimentary bottled water
Full coordination',
            'package_itinerary' =>
'Sorsogon Museum
Sorsogon Cathedral
Sorsogon City Rolling Tour
Gubat Beach
Barcelona Church
Bulusan Lake
Zoe Eco Adventure Resort or Mateo Hot Spring
Plaza Escudero'
        ]);
              $package = Package::create([
                  'tour_operator_id' => '200008',
                  'package_name' => 'Calaguas',
                  'package_description' => 'Open for joiners.',
                  'package_rate' => 'Php 3199/ pax (minimum of 10 pax)',
                  'package_minimum_fee' => '1380',
                  'package_inclusions' =>
'RT Boat Transfers
Tent Accommodation
3 meals
All permit and entrances
Tour Coordinator
Island activities
Trekking guide',
                  'package_itinerary' =>
'Camping
Swimming
Island Hopping
Beach
Hiking'
        ]);
        $package = Package::create([
            'tour_operator_id' => '200009',
            'package_name' => 'ATV Tour to Mayon Volcano',
            'package_description' => '  This tour is a one-of-a-kind ATV experience going to Mayon Volcano’s Hardened Lava crossing small rivers and hard trail. Once you avail this adventure, you can say that “you’ve not only seen Mayon, but you’ve been to Mayon!”',
            'package_rate' => 'P1,850.00/pax',
            'package_minimum_fee' => '1850',
            'package_inclusions' =>
'ATV rental
Helmet
Mayon Trail Guide
Hotel Transfers',
            'package_itinerary' =>
'12:00 PM - Departure, proceed to ATV Starting Point (Brgy. Pawa, Legazpi City)
12: 15 PM - Estimated Time of Arrival in the starting point / Briefing / Drive Test of Units
12:45 PM - Start of ATV Ride at the foot of Mayon Volcano
1:30 PM	- Estimated Time of Arrival in Mayon Base Camp / Rest
1:35 PM	- Short but hard Trek to the Lava Bed
1:50 PM	- Rest or Picture Taking then trek back
2:15 PM	- Ride back to the starting site
3:00 PM	- Estimated Time of Arrival / Back To Hotel'
        ]);
    }
}
