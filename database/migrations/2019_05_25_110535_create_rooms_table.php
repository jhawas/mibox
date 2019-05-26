<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();
            
            $table->string('description')->nullable();

            $table->integer('capacity')->nullable();

            $table->integer('floor_id')->unsigned()->nullable();
            $table->foreign('floor_id')->references('id')->on('floors')->onDelete('cascade');

            $table->integer('type_of_charge_id')->unsigned()->nullable();
            $table->foreign('type_of_charge_id')->references('id')->on('type_of_charges')->onDelete('cascade');
            
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unique(array('name', 'floor_id', 'type_of_charge_id'));
            
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
        Schema::dropIfExists('rooms');
    }
}
