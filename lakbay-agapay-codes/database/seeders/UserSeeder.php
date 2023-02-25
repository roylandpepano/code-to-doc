<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*admins*/
        $user = User::create([
            'user_type' => 'Admin',
            'user_picture' => "img/avatar/1 say.jpg",
            'user_fname' => 'Lindsay',
            'user_mname' => 'Fulla',
            'user_lname' => 'Belleza',
            'user_address' => 'Bulusan, Sorsogon',
            'user_phone' => '09999999991',
            'user_username' => 'Say',
            'user_email' => 'lindsay@example.net',
            'email_verified_at' => now(),
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_logged_in_using' => 'Email',
            'google_id' => 'null',
            'remember_token' => Str::random(10)
        ]);
        $user = User::create([
            'user_type' => 'Admin',
            'user_picture' => "img/avatar/2 cj.jpg",
            'user_fname' => 'Chris',
            'user_mname' => 'Nobleza',
            'user_lname' => 'Alamares',
            'user_address' => 'Oas, Albay',
            'user_phone' => '09999999992',
            'user_username' => 'CJ',
            'user_email' => 'chris@example.net',
            'email_verified_at' => now(),
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_logged_in_using' => 'Email',
            'google_id' => 'null',
            'remember_token' => Str::random(10)
        ]);
        $user = User::create([
            'user_type' => 'Super Admin',
            'user_picture' => "img/avatar/3 dom.jpg",
            'user_fname' => 'Dominic',
            'user_mname' => 'Baranda',
            'user_lname' => 'Escoto',
            'user_address' => 'Albay',
            'user_phone' => '09999999993',
            'user_username' => 'Dom',
            'user_email' => 'dominic@example.net',
            'email_verified_at' => now(),
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_logged_in_using' => 'Email',
            'google_id' => 'null',
            'remember_token' => Str::random(10)
        ]);
        $user = User::create([
            'user_type' => 'Admin',
            'user_picture' => "img/avatar/4 roy.jpg",
            'user_fname' => 'Royland',
            'user_mname' => 'Verano',
            'user_lname' => 'Pepano',
            'user_address' => 'Pio Duran, Albay',
            'user_phone' => '09999999994',
            'user_username' => 'Roy',
            'user_email' => 'royland@example.net',
            'email_verified_at' => now(),
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_logged_in_using' => 'Email',
            'google_id' => 'null',
            'remember_token' => Str::random(10)
        ]);
        $user = User::create([
            'user_type' => 'Tourist',
            'user_picture' => "img/avatar/5 harold.jpg",
            'user_fname' => 'Harold',
            'user_mname' => 'Roy',
            'user_lname' => 'Razal',
            'user_address' => 'Angono, Rizal',
            'user_phone' => '09999999995',
            'user_username' => 'Harold',
            'user_email' => 'harold@example.net',
            'email_verified_at' => now(),
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_logged_in_using' => 'Email',
            'google_id' => 'null',
            'remember_token' => Str::random(10)
        ]);

        /*tourists*/
        $user = User::create([
            'user_type' => 'Tourist',
            'user_picture' => "img/avatar/6 eileen.jpg",
            'user_fname' => 'Eileen',
            'user_mname' => 'Rene',
            'user_lname' => 'Bradshaw',
            'user_address' => 'Tiwi, Albay',
            'user_phone' => '09999999100',
            'user_username' => 'Rene',
            'user_email' => 'rene@example.net',
            'email_verified_at' => now(),
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_logged_in_using' => 'Email',
            'google_id' => 'null',
            'remember_token' => Str::random(10)
        ]);
        $user = User::create([
            'user_type' => 'Tourist',
            'user_picture' => "img/avatar/7 rowan.jpg",
            'user_fname' => 'Rowan',
            'user_mname' => 'Caprice',
            'user_lname' => 'Reeves',
            'user_address' => 'Camalig, Albay',
            'user_phone' => '09999999996',
            'user_username' => 'Rowan',
            'user_email' => 'rowan@example.net',
            'email_verified_at' => now(),
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_logged_in_using' => 'Email',
            'google_id' => 'null',
            'remember_token' => Str::random(10)
        ]);
        $user = User::create([
            'user_type' => 'Tourist',
            'user_picture' => "img/avatar/8 serenity.jpg",
            'user_fname' => 'Serenity',
            'user_mname' => 'Everett',
            'user_lname' => 'Crane',
            'user_address' => 'Bacacay, Albay',
            'user_phone' => '09999999997',
            'user_username' => 'Serenity',
            'user_email' => 'serenity@example.net',
            'email_verified_at' => now(),
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_logged_in_using' => 'Email',
            'google_id' => 'null',
            'remember_token' => Str::random(10)
        ]);
        $user = User::create([
            'user_type' => 'Tourist',
            'user_picture' => "img/avatar/9 melody.jpg",
            'user_fname' => 'Melody',
            'user_mname' => 'Reese',
            'user_lname' => 'Stark',
            'user_address' => 'Legazpi City, Albay',
            'user_phone' => '09999999998',
            'user_username' => 'Melody',
            'user_email' => 'melody@example.net',
            'email_verified_at' => now(),
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_logged_in_using' => 'Email',
            'google_id' => 'null',
            'remember_token' => Str::random(10)
        ]);
        $user = User::create([
            'user_type' => 'Tourist',
            'user_picture' => "img/avatar/10 allen.jpg",
            'user_fname' => 'Allen',
            'user_mname' => 'Malto',
            'user_lname' => 'Amara',
            'user_address' => 'Ligao City, Albay',
            'user_phone' => '09999999999',
            'user_username' => 'Amara',
            'user_email' => 'amara@example.net',
            'email_verified_at' => now(),
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_logged_in_using' => 'Email',
            'google_id' => 'null',
            'remember_token' => Str::random(10)
        ]);
        $user = User::create([
            'user_type' => 'Tourist',
            'user_picture' => "img/avatar/11 jase.jpg",
            'user_fname' => 'Jase',
            'user_mname' => 'Jack',
            'user_lname' => 'Clarke',
            'user_address' => 'Ligao City, Albay',
            'user_phone' => '09999999910',
            'user_username' => 'Jase',
            'user_email' => 'jase@example.net',
            'email_verified_at' => now(),
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_logged_in_using' => 'Email',
            'google_id' => 'null',
            'remember_token' => Str::random(10)
        ]);
        $user = User::create([
            'user_type' => 'Tourist',
            'user_picture' => "img/avatar/12 kai.jpg",
            'user_fname' => 'Kai',
            'user_mname' => 'Brandt',
            'user_lname' => 'Haley',
            'user_address' => 'Oas, Albay',
            'user_phone' => '09999999911',
            'user_username' => 'Kai',
            'user_email' => 'kai@example.net',
            'email_verified_at' => now(),
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_logged_in_using' => 'Email',
            'google_id' => 'null',
            'remember_token' => Str::random(10)
        ]);
        $user = User::create([
            'user_type' => 'Tourist',
            'user_picture' => "img/avatar/13 savannah.jpg",
            'user_fname' => 'Savannah',
            'user_mname' => 'Janetta',
            'user_lname' => 'Soto',
            'user_address' => 'Pio Duran, Albay',
            'user_phone' => '09999999912',
            'user_username' => 'Savannah',
            'user_email' => 'savannah@example.net',
            'email_verified_at' => now(),
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_logged_in_using' => 'Email',
            'google_id' => 'null',
            'remember_token' => Str::random(10)
        ]);
        $user = User::create([
            'user_type' => 'Tourist',
            'user_picture' => "img/avatar/14 isaac.jpg",
            'user_fname' => 'Isaac',
            'user_mname' => 'Brighton',
            'user_lname' => 'Nielsen',
            'user_address' => 'Oas, Albay',
            'user_phone' => '09999999913',
            'user_username' => 'Isaac',
            'user_email' => 'isaac@example.net',
            'email_verified_at' => now(),
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_logged_in_using' => 'Email',
            'google_id' => 'null',
            'remember_token' => Str::random(10)
        ]);
        $user = User::create([
            'user_type' => 'Tourist',
            'user_picture' => "img/avatar/15 lydia.jpg",
            'user_fname' => 'Lydia',
            'user_mname' => 'Grant',
            'user_lname' => 'Mcgrath',
            'user_address' => 'Legazpi City, Albay',
            'user_phone' => '09999999914',
            'user_username' => 'Lydia',
            'user_email' => 'lydia@example.net',
            'email_verified_at' => now(),
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_logged_in_using' => 'Email',
            'google_id' => 'null',
            'remember_token' => Str::random(10)
        ]);
        $user = User::create([
            'user_type' => 'Tourist',
            'user_picture' => "img/avatar/16 elijah.jpg",
            'user_fname' => 'Elijah',
            'user_mname' => 'Oconnell',
            'user_lname' => 'Ware',
            'user_address' => 'Daraga, Albay',
            'user_phone' => '09999999915',
            'user_username' => 'Elijah',
            'user_email' => 'elijah@example.net',
            'email_verified_at' => now(),
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_logged_in_using' => 'Email',
            'google_id' => 'null',
            'remember_token' => Str::random(10)
        ]);

        /*tour operators*/
        $user = User::create([
            'user_type' => 'Tour Operator',
            'user_picture' => "img/avatar/17 libby.jpg",
            'user_fname' => 'Libby',
            'user_mname' => 'Rory',
            'user_lname' => 'Willis',
            'user_address' => 'Daraga, Albay',
            'user_phone' => '09999999916',
            'user_username' => 'Libby',
            'user_email' => 'libby@example.net',
            'email_verified_at' => now(),
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_logged_in_using' => 'Email',
            'google_id' => 'null',
            'remember_token' => Str::random(10)
        ]);
        $user = User::create([
            'user_type' => 'Tour Operator',
            'user_picture' => "img/avatar/18 lindon.jpg",
            'user_fname' => 'Lindon',
            'user_mname' => 'Ellory',
            'user_lname' => 'Bennett',
            'user_address' => 'Polangui, Albay',
            'user_phone' => '09999999917',
            'user_username' => 'Lindon',
            'user_email' => 'lindon@example.net',
            'email_verified_at' => now(),
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_logged_in_using' => 'Email',
            'google_id' => 'null',
            'remember_token' => Str::random(10)
        ]);
        $user = User::create([
            'user_type' => 'Tour Operator',
            'user_picture' => "img/avatar/19 aaron.jpg",
            'user_fname' => 'Aaron',
            'user_mname' => 'Brock',
            'user_lname' => 'Marks',
            'user_address' => 'Ligao, Albay',
            'user_phone' => '09999999918',
            'user_username' => 'Aaron',
            'user_email' => 'aaron@example.net',
            'email_verified_at' => now(),
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_logged_in_using' => 'Email',
            'google_id' => 'null',
            'remember_token' => Str::random(10)
        ]);
        $user = User::create([
            'user_type' => 'Tour Operator',
            'user_picture' => "img/avatar/20 blaise.jpg",
            'user_fname' => 'Blaise',
            'user_mname' => 'Finn',
            'user_lname' => 'Grant',
            'user_address' => 'Legazpi City, Albay',
            'user_phone' => '09999999919',
            'user_username' => 'Blaise',
            'user_email' => 'blaise@example.net',
            'email_verified_at' => now(),
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_logged_in_using' => 'Email',
            'google_id' => 'null',
            'remember_token' => Str::random(10)
        ]);
        $user = User::create([
            'user_type' => 'Tour Operator',
            'user_picture' => "img/avatar/21 siena.jpg",
            'user_fname' => 'Siena',
            'user_mname' => 'Cerise',
            'user_lname' => 'Zuniga',
            'user_address' => 'Tabaco City, Albay',
            'user_phone' => '09999999920',
            'user_username' => 'Siena',
            'user_email' => 'siena@example.net',
            'email_verified_at' => now(),
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_logged_in_using' => 'Email',
            'google_id' => 'null',
            'remember_token' => Str::random(10)
        ]);
        $user = User::create([
            'user_type' => 'Tour Operator',
            'user_picture' => "img/avatar/22 shyann.jpg",
            'user_fname' => 'Shyann',
            'user_mname' => 'Bernice',
            'user_lname' => 'Frye',
            'user_address' => 'Legazpi City, Albay',
            'user_phone' => '09999999921',
            'user_username' => 'Shyann',
            'user_email' => 'shyann@example.net',
            'email_verified_at' => now(),
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_logged_in_using' => 'Email',
            'google_id' => 'null',
            'remember_token' => Str::random(10)
        ]);$user = User::create([
        'user_type' => 'Tour Operator',
        'user_picture' => "img/avatar/23 kassidy.jpg",
        'user_fname' => 'Kassidy',
        'user_mname' => 'Noah',
        'user_lname' => 'Friedman',
        'user_address' => 'Tabaco City, Albay',
        'user_phone' => '09999999922',
        'user_username' => 'Kassidy',
        'user_email' => 'kassidy@example.net',
        'email_verified_at' => now(),
        'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'user_logged_in_using' => 'Email',
        'google_id' => 'null',
        'remember_token' => Str::random(10)
    ]);$user = User::create([
        'user_type' => 'Tour Operator',
        'user_picture' => "img/avatar/24 kayleigh.jpg",
        'user_fname' => 'Kayleigh',
        'user_mname' => 'Blake',
        'user_lname' => 'Harding',
        'user_address' => 'Malinao, Albay',
        'user_phone' => '09999999923',
        'user_username' => 'Kayleigh',
        'user_email' => 'kayleigh@example.net',
        'email_verified_at' => now(),
        'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'user_logged_in_using' => 'Email',
        'google_id' => 'null',
        'remember_token' => Str::random(10)
    ]);
        $user = User::create([
            'user_type' => 'Tour Operator',
            'user_picture' => "img/avatar/25 valentina.jpg",
            'user_fname' => 'Luis',
            'user_mname' => 'Loyola',
            'user_lname' => '',
            'user_address' => 'Harong Pagkamoot, Rubia St, Daraga, 4501 Albay',
            'user_phone' => '09923034401',
            'user_username' => 'Luis',
            'user_email' => 'luis@tourifictravelservices.com',
            'email_verified_at' => now(),
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_logged_in_using' => 'Email',
            'google_id' => 'null',
            'remember_token' => Str::random(10)
        ]);
        $user = User::create([
            'user_type' => 'Tour Operator',
            'user_picture' => "img/avatar/26 albert.jpg",
            'user_fname' => 'Albert',
            'user_mname' => 'Brighton',
            'user_lname' => 'Lee',
            'user_address' => 'Guinobatan, Albay',
            'user_phone' => '09999999925',
            'user_username' => 'Albert',
            'user_email' => 'albert@example.net',
            'email_verified_at' => now(),
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_logged_in_using' => 'Email',
            'google_id' => 'null',
            'remember_token' => Str::random(10)
        ]);


    }
}
