<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors_orders', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('patient_record_id')->unsigned()->nullable();
            $table->foreign('patient_record_id')->references('id')->on('patient_records')->onDelete('cascade');
            
            $table->date('date')->nullable();
            $table->time('time')->nullable();

            $table->longText('progress_note')->nullable();

            $table->longText('orders')->nullable();

            $table->boolean('is_laboratory')->default(0)->nullable();

            $table->json('laboratories')->nullable();

            $table->integer('requested_by')->unsigned()->nullable();
            $table->foreign('requested_by')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('doctors_orders');
    }
}
