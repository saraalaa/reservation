<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_doctor_id')->nullable(true);
            $table->foreignId('user_id')->nullable(true);
            $table->enum('status',['pending','accepted','rejected'])->default('pending');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users');

            $table->foreign('profile_doctor_id')
                ->references('id')->on('profile_doctors');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
