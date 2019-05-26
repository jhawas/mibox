<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_records', function (Blueprint $table) {
            
            $table->increments('id');

            $table->integer('patient_id')->unsigned()->nullable();
            
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');

            $table->string('record_type')->nullable();

            $table->integer('admitted_and_check_up_by')->unsigned()->nullable();
            $table->foreign('admitted_and_check_up_by')->references('id')->on('users')->onDelete('cascade');
            
            $table->date('addmitted_and_check_up_date')->nullable();
            $table->time('addmitted_and_check_up_time')->nullable();

            $table->integer('discharge_by')->unsigned()->nullable();
            $table->foreign('discharge_by')->references('id')->on('users')->onDelete('cascade');
            $table->date('discharge_date')->nullable();
            $table->time('discharge_time')->nullable();

            $table->integer('attending_physician')->unsigned()->nullable();
            $table->foreign('attending_physician')->references('id')->on('users')->onDelete('cascade');

            $table->integer('chart_completed_by')->unsigned()->nullable();
            $table->foreign('chart_completed_by')->references('id')->on('users')->onDelete('cascade');

            $table->integer('room_id')->unsigned()->nullable();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');

            $table->string('bed')->nullable();

            $table->string('disposition')->nullable();

            $table->integer('philhealth_membership')->nullable();

            $table->string('sponsor')->nullable();

            $table->integer('result')->nullable();

            $table->string('chief_complaints')->nullable();

            $table->string('brief_history')->nullable();

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
        Schema::dropIfExists('patient_records');
    }
}
