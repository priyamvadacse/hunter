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
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('package_id')->unsigned();
            $table->foreign('package_id')->references('id')->on('subscription_packages')->onDelete('cascade');
            $table->string('r_payment_id');
            $table->string('method')->default('online');
            $table->string('currency')->default('INR');            
            $table->decimal('amount',10,2);
            $table->longText('json_response')->nullable();
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
        Schema::dropIfExists('payment_transactions');
    }
};
