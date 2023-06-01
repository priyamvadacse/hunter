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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('package_id')->unsigned();
            $table->foreign('package_id')
                    ->references('id')->on('subscription_packages')
                    ->cascadeOnDelete()
                    ->cascdeOnUpdate();
            // $table->string('name');
            $table->decimal('price',8,2);
            $table->date('start_date');
            $table->date('expire_date');
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
        Schema::dropIfExists('offers');
    }
};
