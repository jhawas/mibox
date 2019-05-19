<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            
            $table->increments('id');
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('suffix')->nullable();
            $table->string('username')->unique()->nullable();
            $table->date('birthdate')->nullable();
            $table->string('religion')->nullable();
            $table->string('sex')->nullable();
            $table->string('address')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('father')->nullable();
            $table->string('mother')->nullable();
            $table->string('spouse')->nullable();
            $table->string('spouse_address')->nullable();
            $table->string('contact_no')->nullable();
            
            // emergency contact
            $table->string('e_name')->nullable();
            $table->string('e_contact')->nullable();
            $table->string('e_address')->nullable();

            $table->unique(array('first_name', 'middle_name', 'last_name', 'suffix'));
            $table->timestamps();

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
