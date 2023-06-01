<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_package_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->references('id')->on('subscription_packages')->restrictOnDelete();
            $table->integer('package_duration');
            $table->integer('price');
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
        Schema::dropIfExists('subscription_package_details');
    }
};
