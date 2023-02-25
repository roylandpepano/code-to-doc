<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destination_packages', function (Blueprint $table) {
            $table->foreignId('destination_id')->nullable(false)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('dest_pkg_name', 100)->nullable(true);
            $table->text('dest_pkg_description')->nullable(true);
            $table->text('dest_pkg_rate')->nullable(true);
            $table->text('dest_pkg_min_fee')->nullable(true);
            $table->text('dest_pkg_inclusions')->nullable(true);
            $table->unique(['destination_id', 'dest_pkg_name']);
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
        Schema::dropIfExists('destination_packages');
    }
}
