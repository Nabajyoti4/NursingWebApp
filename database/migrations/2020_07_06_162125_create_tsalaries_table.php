<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tsalaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('nurse_id')->index();
            $table->bigInteger('basic');
            $table->string('month_days');
            $table->bigInteger('per_day_rate');
            $table->integer('full_day')->default(0);
            $table->integer('half_day')->default(0);
            $table->bigInteger('special_allowance')->default(0);
            $table->bigInteger('ta_da')->default(0);
            $table->bigInteger('hra')->default(0);
            $table->bigInteger('bonus')->default(0);
            $table->bigInteger('advance')->default(0);
            $table->bigInteger('total');
            $table->bigInteger('deduction');
            $table->bigInteger('net');
            $table->string('area')->nullable();
            $table->string('payment_received_date')->nullable();
            $table->mediumText('remarks')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('tsalaries');
    }
}
