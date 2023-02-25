<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourOperatorRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_operator_ratings', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable(false)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('tour_operator_id')->nullable(false)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('rating_rate')->nullable(false);
            $table->string('rating_review', 500)->nullable(false);
            $table->string('rating_picture1')->nullable(false);
            $table->string('rating_picture2')->nullable(false);
            $table->string('rating_picture3')->nullable(false);
            $table->unique(['user_id', 'tour_operator_id']);
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
        Schema::dropIfExists('tour_operator_ratings');
    }
}
