<?php

namespace Database\Seeders;

use App\Models\TourOperator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TourOperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tour_operator = TourOperator::create([
            'user_id' => '17',
            'operator_company' => 'Trevally Travel and Tours',
            'operator_main_picture' => "img/tour_operator_images/200001operator_image2.jpg",
            'operator_operating' => 0,
            'operator_location' => 'Purok 7, Bogtong, Legazpi City, Albay',
            'operator_city' => 'Legazpi',
            'operator_description' => '    The term ‘trevally’ might sound unfamiliar to several people. It is an English term that refers to a fish called Baulo or Talakitok. This is the name given to the agency as it symbolizes the owner’s fondness for the sun and the sea. Trevally Travel and Tours is located at Purok 7, Bogtong, Legazpi City, Albay, Bicol Region. They started in Tabaco City in 2012 and has moved to its recent address in 2015. It is a trusted travel agency that is duly licensed, supported by its DTI Certificate No. 3775870 and its accreditation from the Department of Tourism. In addition, it is also a part of the Accredited Travel Agencies of Bicol, Inc. (ACTA-Bicol). Their team is comprised of well experienced individuals. Together, they aim to satisfy customers by providing world-class services at an affordable price.',
            'operator_services' => '    Domestic and International Airline Ticketing, Domestic and International Hotel Reservations, Asian Tour Packages, Other International Tour Packages, Island Hopping Packages and City Tours within Bicol, Holiday Travel Packages throughout the Philippines, Educational Tours/ School and Company Teambuilding/Seminars, LGU Lakbay Aral/Benchmarking Tours, and MICE (Meeting, Incentive, Convention, Exhibition)',
            'operator_email' => 'trevallytravel@yahoo.com',
            'operator_phone_number' =>'09175263388',
            'operator_fb' => 'https://www.facebook.com/TrevallyTravel',
            'operator_twitter' => 'https://twitter.com/trevallytravel',
            'operator_instagram' => '',
            'operator_website' => 'https://trevallytravel.com/',
            'operator_approval' => 'Approved',
            'operator_reasons' => 'Saepe facilis autem voluptatibus occaecati nemo. In eaque deleniti quasi ullam enim eaque in est. Quae temporibus hic soluta beatae. Distinctio nihil laboriosam quam voluptatum velit unde. Nostrum in ab sint vitae.',
            'operator_rating_average'=> '0'
        ]);
        $tour_operator = TourOperator::create([
            'user_id' => '18',
            'operator_company' => 'The Bachelor Travel & Tours',
            'operator_main_picture' => "img/tour_operator_main_pic/200002main.jpg",
            'operator_operating' => 0,
            'operator_location' => 'Brgy.3 Poblacion Camalig,Albay , Legazpi, Philippines',
            'operator_city' => 'Camalig',
            'operator_description' => '    We are a DOT accredited Travel and Tour Agency since 2020. This accreditation is valid until June 30,2024.',
            'operator_services' => '    Hotel, Tour Packages, Visa Assistance, and Airlines Ticketing',
            'operator_email' => 'dbachelor0817@gmail.com',
            'operator_phone_number' =>'09770989806',
            'operator_fb' => 'https://www.facebook.com/7diamondtravelandtours',
            'operator_twitter' => '',
            'operator_instagram' => 'https://www.instagram.com/mjonel',
            'operator_website' => 'https://www.7diamond.com.ph/',
            'operator_approval' => 'Approved',
            'operator_reasons' => 'Saepe facilis autem voluptatibus occaecati nemo. In eaque deleniti quasi ullam enim eaque in est. Quae temporibus hic soluta beatae. Distinctio nihil laboriosam quam voluptatum velit unde. Nostrum in ab sint vitae.',
            'operator_rating_average'=> '0'
        ]);
        $tour_operator = TourOperator::create([
            'user_id' => '19',
            'operator_company' => 'eVintage Travel & Tours',
            'operator_main_picture' => "img/tour_operator_main_pic/200003main.jpg",
            'operator_operating' => 0,
            'operator_location' => '007 Binanuahan West 4500 Legazpi, Philippines',
            'operator_city' => 'Legazpi',
            'operator_description' => '    I am a SME businessman with computer and internet-shop owner/ love to see picture in all forms with majestic view and in short I am a gamer. I love exploring the internet in all aspects until i meet one of the client, shared me the ideas about travel ticketing agent. and became my consultant and "good friend". So, in the process I found it very convincing and optimistic in doing the routine of making online partner, travel link together in real time. At first, I found it not that easy so I try asking to selected friend to help me finance the ticketing/ as my sub-agent unfortunately, they also found it hard to communicate considering the time element and the aspects of doing it via excellent internet signal in the whole year round. then, they do not want it and ask me back to do the process in ticketing. I was challenge to do ticketing and expand it to travel and tours business. I am a one man army, I claimed it to my self, as i am the only one doing all the aspects to set up the travel and tours agency. Until i found connections to newly formed Travel Cooperative to help me strengthen and expand my eVintage Travel & Tours to a new level of service/ until this present time/day.',
            'operator_services' => '    Flight Ticketing, Tour Packages,  and Car/ Van/ Boat Rental',
            'operator_email' => 'evintage.ph@gmail.com',
            'operator_phone_number' =>'09274555448',
            'operator_fb' => 'https://www.facebook.com/eVintage.GM',
            'operator_twitter' => '',
            'operator_instagram' => '',
            'operator_website' => 'http://evintagetravel.weebly.com/',
            'operator_approval' => 'Rejected',
            'operator_reasons' => 'Saepe facilis autem voluptatibus occaecati nemo. In eaque deleniti quasi ullam enim eaque in est. Quae temporibus hic soluta beatae. Distinctio nihil laboriosam quam voluptatum velit unde. Nostrum in ab sint vitae.',
            'operator_rating_average'=> '0'
        ]);
        $tour_operator = TourOperator::create([
            'user_id' => '20',
            'operator_company' => 'Jra Tour & Travel Services',
            'operator_main_picture' => "img/tour_operator_main_pic/200004main.jpg",
            'operator_operating' => 0,
            'operator_location' => '#313 Juan Estevez Street, Guevarra Subdivision, Bgy. 18 - Cabagñan West, Philippines, 4500',
            'operator_city' => 'Legazpi',
            'operator_description' =>
'    JRA TOUR & TRAVEL SERVICES, is a travel management company that provides services to all types of travelers.  We ensure safety, hassle – free and a memorable travel experience to all.  To provide such, we partnered with accredited travel tour & transport operators, hotels, resorts and other establishments to give excellent travel services to our customers. We attend to our client’s utmost need by guiding & assisting them in making their dream destination within their reach.
    Our company is located in the heart of Legazpi City, also called as “City of Fun & Adventure.” Also, known for having the Majestic Mayon Volcano. Experience the beautiful scenery, extreme adventure & relaxing atmosphere as we make your travel fun & an unforgettable one!',
            'operator_services' => '    Inbound, Outbound and Local Tours, Internship Programs, Ticketing & Hotel Reservations Worldwide, Educational Tours, Adventure & Incentive Tours, Local Excursions, Cruises, Scuba Diving & Travel Insurance, Transportation Rental, and Visa Processing',
            'operator_email' => 'jratravels88@gmail.com',
            'operator_phone_number' =>'',
            'operator_fb' => 'https://www.facebook.com/jratourandtravelservices',
            'operator_twitter' => '',
            'operator_instagram' => '',
            'operator_website' => '',
            'operator_approval' => 'Approved',
            'operator_reasons' => 'Saepe facilis autem voluptatibus occaecati nemo. In eaque deleniti quasi ullam enim eaque in est. Quae temporibus hic soluta beatae. Distinctio nihil laboriosam quam voluptatum velit unde. Nostrum in ab sint vitae.',
            'operator_rating_average'=> '0'
        ]);
        $tour_operator = TourOperator::create([
            'user_id' => '21',
            'operator_company' => 'SmartFlight Travel and Academic Services',
            'operator_main_picture' => "img/tour_operator_main_pic/200005main.jpg",
            'operator_operating' => 0,
            'operator_location' => '4th Floor, Ayala Malls, Quezon Avenue, Legazpi, Philippines',
            'operator_city' => 'Legazpi',
            'operator_description' =>
'    SmartFlight is a Phillippine-based travel and academic service company trusted since 2010 in delivering a wide array of services that are stress free and cost workable for every traveler.
    SmartFlight has immersed more than just the most seeked travel company but as a travel advocate that serves with a high standard of services inspired by its clients positive reviews and historical partnership with renowned companies, families, and groups.
    Smartflight is an active member and partner of DOT, PTAA, PHILTOA, and the PTB. Smartflight continuously evolve, adapt, and remain sustainable by attending international travel trade shows, maintain close relationships with the airlines, hotels, embassies, government agencies, and the rest of the travel and tourism stakeholders, and by listening closely to every client\'s need.',
            'operator_services' => 'Travel Package, Airline Ticketing, Visa Application Assistance, and Hotel Booking',
            'operator_email' => 'smartflightgm@gmail.com',
            'operator_phone_number' =>'09173323232',
            'operator_fb' => 'https://www.facebook.com/smartflight.ph',
            'operator_twitter' => '',
            'operator_instagram' => '',
            'operator_website' => 'https://smartflight.webs.com/',
            'operator_approval' => 'Approved',
            'operator_reasons' => 'Saepe facilis autem voluptatibus occaecati nemo. In eaque deleniti quasi ullam enim eaque in est. Quae temporibus hic soluta beatae. Distinctio nihil laboriosam quam voluptatum velit unde. Nostrum in ab sint vitae.',
            'operator_rating_average'=> '0'
        ]);
        $tour_operator = TourOperator::create([
            'user_id' => '22',
            'operator_company' => 'Human Explore Travel and Tours',
            'operator_main_picture' => "img/tour_operator_main_pic/200006main.jpg",
            'operator_operating' => 0,
            'operator_location' => 'G/F Achacon Building 658 Rizal Street 4500 Legaspi, Philippines',
            'operator_city' => 'Legazpi',
            'operator_description' => '    We provide the best possible services with a reasonable price of one package from different places in different country by providing quality services to meet the demands of the traveler. Attended the Travel Agency Course at Asia Pacific Tourism Training Institute, Intramuros Manila.',
            'operator_services' => '    Travel and Tours Booking and Online Booking',
            'operator_email' => '',
            'operator_phone_number' =>'09209523436',
            'operator_fb' => 'https://www.facebook.com/humanexploretravelandtours',
            'operator_twitter' => '',
            'operator_instagram' => '',
            'operator_website' => '',
            'operator_approval' => 'Approved',
            'operator_reasons' => 'Saepe facilis autem voluptatibus occaecati nemo. In eaque deleniti quasi ullam enim eaque in est. Quae temporibus hic soluta beatae. Distinctio nihil laboriosam quam voluptatum velit unde. Nostrum in ab sint vitae.',
            'operator_rating_average'=> '0'
        ]);
        $tour_operator = TourOperator::create([
            'user_id' => '23',
            'operator_company' => 'JMO Adventure Travel and Tours',
            'operator_main_picture' => "img/tour_operator_main_pic/200007main.png",
            'operator_operating' => 0,
            'operator_location' => 'Rizal St, Legazpi, Philippines',
            'operator_city' => 'Legazpi',
            'operator_description' =>
'    Need travel assistance?
    Just visit our office located at Rizal St. Sagpon Daraga, Albay. We cater tour packages, domestic and international airline ticketing, lakbay aral, educational tour, company private and lgu.
    We are happy and willing to assist you with good and quality services.
    Tara Travel tayo! See you there',
            'operator_services' => '    Domestic and International Airlines, Visa Processing and Assistance, Local and International Tour Packages, and Travel Insurance',
            'operator_email' => 'jmoadventuretraveltours@gmail.com',
            'operator_phone_number' =>'09473723985',
            'operator_fb' => 'https://www.facebook.com/jmoadventuretravelandtours',
            'operator_twitter' => '',
            'operator_instagram' => '',
            'operator_website' => '',
            'operator_approval' => 'Approved',
            'operator_reasons' => 'Saepe facilis autem voluptatibus occaecati nemo. In eaque deleniti quasi ullam enim eaque in est. Quae temporibus hic soluta beatae. Distinctio nihil laboriosam quam voluptatum velit unde. Nostrum in ab sint vitae.',
            'operator_rating_average'=> '0'
        ]);
        $tour_operator = TourOperator::create([
            'user_id' => '24',
            'operator_company' => 'QUEEN J Travel and Tours',
            'operator_main_picture' => "img/tour_operator_main_pic/200008main.jpg",
            'operator_operating' => 0,
            'operator_location' => 'Maharlika Hi-way P-1 Kimantong Daraga Albay, Daraga, Philippines, 4501',
            'operator_city' => 'Daraga',
            'operator_description' => '    Queen J Travel and Tours is a DOT ACCREDITED Travel and Tour Agency in Bicol Region, located in Maharlika Hi-way Kimantong, Daraga, Albay. Our company offers tour packages in the Bicol Region, majestic islands in Boracay, Cebu, Bohol, Puerto Princesa, Coron, El Nido and other Philippine tourist destinations. We have an exclusive or public tour at reasonable prices. Apart from tour packages, we also have airline ticketing services both domestic and international.',
            'operator_services' => '    Hotel and Resort Booking, Domestic and International Tour Packages, and Airline Ticketing',
            'operator_email' => 'queenjtravel@yahoo.com',
            'operator_phone_number' =>'09778558088',
            'operator_fb' => 'https://www.facebook.com/QUEENJTravelandTours',
            'operator_twitter' => '',
            'operator_instagram' => '',
            'operator_website' => 'https://queenjtravel.weebly.com/',
            'operator_approval' => 'Approved',
            'operator_reasons' => 'Saepe facilis autem voluptatibus occaecati nemo. In eaque deleniti quasi ullam enim eaque in est. Quae temporibus hic soluta beatae. Distinctio nihil laboriosam quam voluptatum velit unde. Nostrum in ab sint vitae.',
            'operator_rating_average'=> '0'
        ]);
        $tour_operator = TourOperator::create([
            'user_id' => '25',
            'operator_company' => 'Tourific Travel Services',
            'operator_main_picture' => "img/tour_operator_main_pic/200009main.jpg",
            'operator_operating' => 0,
            'operator_location' => 'Harong Pagkamoot, Rubia St, Daraga, 4501 Albay',
            'operator_city' => 'Daraga',
            'operator_description' => '    Tourific Travel Services is a Department of Tourism – Accredited Tour Operator providing totally reliable competitively tour packages. We offer a wide and varied choice of fascinating holidays primarily to Legazpi City of Albay Province featuring Mayon Volcano and also to other popular destinations within Bicol Region. We specialize in day tour packages within the provinces of Albay, Sorsogon and Camarines Sur like Mayon Legazpi Sight-Seeing Tours, ATV Adventure to Mayon Volcano, Donsol Whaleshark Interaction, Matnog Subic Beach Excursion and Camarines Sur Escapade. We also showcase famous Philippine tourist spots outside our region. We tender complete local and ground arrangements at the most reasonable prices to individual travelers, families and special interest groups. Furthermore, we cater educational tours for students, exposure trips for local government units and leisure travel for private companies. We are capable of delivering the most well-organized tour packages and travel requirements in the midst of our efficient and professional services with competent management. We aim to create the most memorable holiday of your life by providing tours which are simply terrific.',
            'operator_services' => '    Mayon Legazpi Sight-Seeing Tours, Adventure Tours in Albay Province, Nature-lover Tours in Sorsogon Province, Exposure Trips in Camarines Sur Province, DOT-accredited Tour Guides for Hire, Nationwide Tour Arrangement, and Assorted Vehicles for Rent',
            'operator_email' => 'luis@tourifictravelservices.com',
            'operator_phone_number' =>'09338636060',
            'operator_fb' => '',
            'operator_twitter' => '',
            'operator_instagram' => '',
            'operator_website' => 'https://tourifictravelservices.com/',
            'operator_approval' => 'Approved',
            'operator_reasons' => 'Saepe facilis autem voluptatibus occaecati nemo. In eaque deleniti quasi ullam enim eaque in est. Quae temporibus hic soluta beatae. Distinctio nihil laboriosam quam voluptatum velit unde. Nostrum in ab sint vitae.',
            'operator_rating_average'=> '0'
        ]);
        $tour_operator = TourOperator::create([
            'user_id' => '26',
            'operator_company' => 'NEXT BICOL RIDE Tour and Transport Service',
            'operator_main_picture' => "img/tour_operator_main_pic/200010main.jpg",
            'operator_operating' => 0,
            'operator_location' => 'Camalig, Philippines',
            'operator_city' => 'Camalig',
            'operator_description' => '    NEXT BICOL RIDE Tour and Transport Service is a DOT Accredited tour operator that provides accommodating service and satisfaction to their customers.',
            'operator_services' => '    Airport Transfer and Tour, Events Van Rental, Family Event Reunion, Company, Family and Barkada Transport Needs, and Luzon Visayas Mindanao Trips',
            'operator_email' => 'NBRtravelandtours@gmail.com',
            'operator_phone_number' => '09150075750.',
            'operator_fb' => 'https://www.facebook.com/NEXTBICOLRIDE',
            'operator_twitter' => '',
            'operator_instagram' => '',
            'operator_website' => '',
            'operator_approval' => 'Pending',
            'operator_reasons' => 'Saepe facilis autem voluptatibus occaecati nemo. In eaque deleniti quasi ullam enim eaque in est. Quae temporibus hic soluta beatae. Distinctio nihil laboriosam quam voluptatum velit unde. Nostrum in ab sint vitae.',
            'operator_rating_average'=> '0'
        ]);

    }
}
