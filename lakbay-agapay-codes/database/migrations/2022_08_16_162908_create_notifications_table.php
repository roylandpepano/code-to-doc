<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->nullable(true)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('tour_operator_id')->nullable(true)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable(true)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('notif_type', 20)->nullable(false);
            $table->string('notif_message', 500)->nullable(false);
            $table->integer('notif_read')->nullable(false);
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
        Schema::dropIfExists('notifications');
    }
}
