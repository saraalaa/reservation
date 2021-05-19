<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_doctors', function (Blueprint $table) {
            $table->id();
            $table->string('speciality');
            $table->text('description');
            $table->decimal('fees',8,2);      // 8 no. of all numbers , 2 for decimal numbers
            $table->text('location');
            $table->boolean('is_approved')->default(false);
            $table->foreignId('user_id');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_doctors');
    }
}
