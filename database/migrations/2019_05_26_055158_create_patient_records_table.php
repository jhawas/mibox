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

            $table->integer('type_of_record_id')->unsigned()->nullable();
            $table->foreign('type_of_record_id')->references('id')->on('type_of_records')->onDelete('cascade');

            $table->integer('room_id')->unsigned()->nullable();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');

            $table->integer('admit_and_check_by')->unsigned()->nullable();
            $table->foreign('admit_and_check_by')->references('id')->on('users')->onDelete('cascade');
            
            $table->date('admit_and_check_date')->nullable();
            $table->time('admit_and_check_time')->nullable();

            $table->integer('discharged_by')->unsigned()->nullable();
            $table->foreign('discharged_by')->references('id')->on('users')->onDelete('cascade');

            $table->date('discharged_date')->nullable();
            $table->time('discharged_time')->nullable();

            $table->integer('physician_id')->unsigned()->nullable();
            $table->foreign('physician_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('chart_completed_by')->unsigned()->nullable();
            $table->foreign('chart_completed_by')->references('id')->on('users')->onDelete('cascade');

            $table->integer('disposition_id')->unsigned()->nullable();
            $table->foreign('disposition_id')->references('id')->on('dispositions')->onDelete('cascade');

            $table->integer('philhealth_membership_id')->unsigned()->nullable();
            $table->foreign('philhealth_membership_id')->references('id')->on('philhealth_memberships')->onDelete('cascade');

            $table->string('sponsor')->nullable();

            $table->integer('result_id')->unsigned()->nullable();
            $table->foreign('result_id')->references('id')->on('results')->onDelete('cascade');

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
