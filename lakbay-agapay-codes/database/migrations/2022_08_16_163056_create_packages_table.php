<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->foreignId('tour_operator_id')->nullable(false)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('package_name', 100)->nullable(false);
            $table->text('package_description')->nullable(false);
            $table->text('package_rate')->nullable(false);
            $table->text('package_minimum_fee' )->nullable(false);
            $table->text('package_inclusions' )->nullable(false);
            $table->text('package_itinerary')->nullable(false);
            $table->unique(['tour_operator_id', 'package_name']);
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
        Schema::dropIfExists('packages');
    }
}
