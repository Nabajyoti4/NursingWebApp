<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->string('patient_name');
            $table->bigInteger('phone_no');
            $table->integer('age');
            $table->string('gender');
            $table->unsignedBigInteger('address_id');
            $table->integer('family_members');
            $table->string('guardian_name');
            $table->string('relation_guardian');
            $table->integer('shift');
            $table->integer('days');
            $table->string('service_type');
            $table->string('patient_history');
            $table->string('patient_doctor');
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
        Schema::dropIfExists('patients');
    }
}