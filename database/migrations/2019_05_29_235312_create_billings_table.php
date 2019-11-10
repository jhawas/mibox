<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('patient_record_id')->unsigned()->nullable();
            $table->foreign('patient_record_id')->references('id')->on('patient_records')->onDelete('cascade');

            $table->integer('type_of_charge_id')->unsigned()->nullable();
            $table->foreign('type_of_charge_id')->references('id')->on('type_of_charges')->onDelete('cascade');

            $table->integer('medication_and_treatment_id')->unsigned()->nullable();
            $table->foreign('medication_and_treatment_id')->references('id')->on('medication_and_treatments')->onDelete('cascade');

            $table->integer('intravenous_fluid_id')->unsigned()->nullable();
            $table->foreign('intravenous_fluid_id')->references('id')->on('intravenous_fluids')->onDelete('cascade');

            $table->integer('laboratory_id')->unsigned()->nullable();
            $table->foreign('laboratory_id')->references('id')->on('laboratories')->onDelete('cascade');

            $table->integer('patient_room_id')->unsigned()->nullable();
            $table->foreign('patient_room_id')->references('id')->on('patient_rooms')->onDelete('cascade');

            $table->decimal('amount', 8, 2)->nullable();

            $table->integer('quantity_and_days')->nullable();

            $table->decimal('total', 8, 2)->nullable();

            $table->longText('description')->nullable();

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
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
        Schema::dropIfExists('billings');
    }
}
