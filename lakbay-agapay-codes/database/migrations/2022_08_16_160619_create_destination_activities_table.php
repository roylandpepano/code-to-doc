<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destination_activities', function (Blueprint $table) {
            $table->foreignId('destination_id')->nullable(false)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('activity', 100)->nullable(true);
            $table->text('activity_description')->nullable(true);
            $table->string('activity_number_of_pax', 500)->nullable(true);
            $table->text('activity_fee')->nullable(true);
            $table->unique(['destination_id', 'activity']);
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
        Schema::dropIfExists('destination_activities');
    }
}
