<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('nurse_id')->index();
            $table->bigInteger('basic');
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
            $table->bigInteger('esic')->nullable();
            $table->bigInteger('pf')->nullable();
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
        Schema::dropIfExists('salaries');
    }
}
