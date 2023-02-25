<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourOperatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_operators', function (Blueprint $table) {
            $table->id()->nullable(false)->startingValue(200001);
            $table->foreignId('user_id')->nullable(false)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('operator_company', 200)->nullable(false);
            $table->string('operator_main_picture', 1000);
            $table->boolean('operator_operating')->nullable(true);
            $table->string('operator_business_permit', 1000)->nullable(true);
            $table->string('operator_location', 200)->nullable(false);
            $table->string('operator_city', 200)->nullable(false);
            $table->text('operator_description')->nullable(false);
            $table->text('operator_services')->nullable(true);
            $table->string('operator_email', 200)->nullable(true);
            $table->string('operator_phone_number', 200)->nullable(true);
            $table->string('operator_fb', 200)->nullable(true);
            $table->string('operator_twitter', 200)->nullable(true);
            $table->string('operator_instagram', 200)->nullable(true);
            $table->string('operator_website', 200)->nullable(true);
            $table->string('operator_approval', 10)->nullable(false);
            $table->text('operator_reasons')->nullable(true);
            $table->float('operator_rating_average')->nullable(true);
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
        Schema::dropIfExists('tour_operators');
    }
}
