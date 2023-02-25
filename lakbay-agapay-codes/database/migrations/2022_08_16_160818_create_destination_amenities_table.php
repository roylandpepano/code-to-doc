<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destination_amenities', function (Blueprint $table) {
            $table->foreignId('destination_id')->nullable(false)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('amenity', 100)->nullable(true);
            $table->text('amenity_description')->nullable(true);
            $table->text('amenity_fee')->nullable(true);
            $table->unique(['destination_id', 'amenity']);
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
        Schema::dropIfExists('destination_amenities');
    }
}
