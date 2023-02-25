<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id()->nullable(false)->startingValue(100001);
            $table->foreignId('user_id')->nullable(false)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->bigInteger('dest_owner')->nullable();
            $table->boolean('dest_operating')->nullable(true);
            $table->string('dest_longitude', 30)->nullable(true);
            $table->string('dest_latitude', 30)->nullable(true);
            $table->string('dest_main_picture', 1000)->nullable(true);
            $table->string('dest_business_permit', 1000)->nullable(true);
            $table->string('dest_name', 200)->nullable(false);
            $table->string('dest_city', 50)->nullable(false);
            $table->string('dest_address', 300)->nullable(false);
            $table->string('dest_phone', 50)->nullable(true);
            $table->string('dest_email', 100)->nullable(true);
            $table->string('dest_date_opened', 50)->nullable(true);
            $table->text('dest_working_hours')->nullable(false);
            $table->text('dest_description')->nullable(false);
            $table->text('dest_direction')->nullable(true);
            $table->text('dest_fare')->nullable(true);
            $table->text('dest_entrance_fee')->nullable(false);
            $table->string('dest_category', 50)->nullable(false);
            $table->string('dest_fb', 500)->nullable(true);
            $table->string('dest_twt', 500)->nullable(true);
            $table->string('dest_ig', 500)->nullable(true);
            $table->string('dest_web', 500)->nullable(true);
            $table->integer('famous')->nullable(false);
            $table->integer('hidden_gem')->nullable(false);
            $table->string('dest_approval', 10)->nullable(false);
            $table->text('dest_reasons')->nullable(true);
            $table->float('dest_rating_average')->nullable(true);
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
        Schema::dropIfExists('destinations');
    }
}
