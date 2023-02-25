<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destination_ratings', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable(false)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('destination_id')->nullable(false)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('rating_rate')->nullable(false);
            $table->string('rating_review', 200)->nullable(false);
            $table->string('rating_picture1')->nullable(false);
            $table->string('rating_picture2')->nullable(false);
            $table->string('rating_picture3')->nullable(false);
            $table->unique(['user_id', 'destination_id']);
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
        Schema::dropIfExists('destination_ratings');
    }
}
