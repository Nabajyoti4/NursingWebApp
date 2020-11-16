<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('patient_id');
            $table->bigInteger('serial');
            $table->bigInteger('serial_money');
            $table->unsignedBigInteger('nurse_id');
            // 0-> Reject , 1-> complete , 2-> pending, 3->running, 4->Takeover
            $table->integer('status')->default(2);
            $table->bigInteger('due_payment');
            $table->bigInteger('total_payment');
            $table->integer('remaining_days');
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
        Schema::dropIfExists('bookings');
    }
}
