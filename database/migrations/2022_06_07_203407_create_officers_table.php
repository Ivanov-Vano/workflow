<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('officers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('surname');
            $table->string('name');
            $table->string('patronymic')->nullable();
      //      $table->string('full_name')->nullable();
            $table->date('birthdate')->nullable();
            $table->enum('gender', ['мужской', 'женский'])->nullable();
            $table->string('sign_image')->nullable();
            $table->string('post')->nullable();
            $table->boolean('actual')->default(TRUE);
            $table->string('personal_number', 50)->nullable();
            $table->string('phone',50)->nullable();
            $table->timestamps();
        });
        Schema::table('users', function (Blueprint $table){
            $table->foreignId('officer_id')->nullable();
            $table->foreign('officer_id')->references('id')->on('officers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table){
            $table->dropForeign(['officer_id']);
        });
        Schema::dropIfExists('officers');
    }
}
