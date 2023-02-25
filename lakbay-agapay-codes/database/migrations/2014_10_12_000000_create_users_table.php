<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->nullable(false);
            $table->string('user_type', 20)->nullable(false);
            $table->string('user_picture')->nullable(false);
            $table->string('user_fname', 30)->nullable(false);
            $table->string('user_mname', 30)->nullable(false);
            $table->string('user_lname', 30)->nullable(false);
            $table->string('user_address', 200)->nullable(false);
            $table->string('user_phone', 30)->nullable(false);
            $table->string('user_username', 20)->nullable(false);
            $table->string('user_email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('user_password', 1000)->nullable(false);
            $table->string('user_logged_in_using', '100')->nullable(false);
            $table->string('google_id');
            $table->rememberToken(); // For remember token in browser
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
