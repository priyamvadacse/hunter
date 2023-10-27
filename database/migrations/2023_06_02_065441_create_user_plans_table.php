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
        Schema::create('user_plans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascdeOnUpdate();
            $table->bigInteger('package_id')->unsigned();
            $table->foreign('package_id')->references('id')->on('subscription_packages')->cascadeOnDelete()->cascdeOnUpdate();
            $table->string('order_number')->nullable();
            $table->decimal('package_amount',8,2)->nullable();
            $table->date('package_active_date')->nullable();
            $table->date('package_expire_date')->nullable();
            $table->date('package_duration')->nullable();
            $table->enum('package_status', ['ACTIVE', 'INACTIVE']);
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
        Schema::dropIfExists('user_plans');
    }
};
