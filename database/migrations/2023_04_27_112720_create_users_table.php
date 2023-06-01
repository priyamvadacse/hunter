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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('pic1');
            $table->integer('phone');
            $table->date('dob');
            $table->enum('gender',['male','female','other'])->default('male');
            $table->enum('interested_in',['male','female','other'])->default('female');
            $table->enum('status', ['ACTIVE', 'INACTIVE'])->default('INACTIVE');
            $table->tinyInteger('verification')->comment('0 = unverified, 1 = verified');
            $table->tinyInteger('relationship')->comment('0 = Long-Term Partner, 1 = Long-Term Open To Short, 2 = Short-Term Open To Long, 3 = Short-Term Fun, 4 = New Friends, 5 = Still Figuring It Out');
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
        Schema::dropIfExists('users');
    }
};
