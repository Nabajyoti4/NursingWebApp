<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePsalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('psalaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('nurse_id')->index();
            $table->bigInteger('month_days')->nullable();
            $table->bigInteger('basic');
            $table->bigInteger('per_day_rate');
            $table->integer('payable_days')->default(0);
            $table->bigInteger('special_allowance')->default(0);
            $table->bigInteger('hra')->default(0);
            $table->bigInteger('esic')->default(0);
            $table->bigInteger('pf')->default(0);
            $table->bigInteger('bonus')->default(0);
            $table->bigInteger('advance')->default(0);
            $table->bigInteger('deduction')->default(0);
            $table->bigInteger('total')->default(0);
            $table->bigInteger('net')->default(0);
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
        Schema::dropIfExists('psalaries');
    }
}
