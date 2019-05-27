<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVitalSignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vital_signs', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('patient_record_id')->unsigned()->nullable();
            $table->foreign('patient_record_id')->references('id')->on('patient_records')->onDelete('cascade');

            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('bp')->nullable();
            $table->string('t')->nullable();
            $table->string('p')->nullable();
            $table->string('r')->nullable();
            $table->integer('intake_oral')->nullable();
            $table->integer('intake_iv')->nullable();
            $table->integer('intake_ng')->nullable();
            $table->integer('total_intake')->nullable();
            $table->integer('output_urine')->nullable();
            $table->integer('output_stool')->nullable();
            $table->integer('output_emesis')->nullable();
            $table->integer('output_ng')->nullable();
            $table->integer('total_output')->nullable();

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
        Schema::dropIfExists('vital_signs');
    }
}
