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
            $table->string('uuid');
            $table->string('post');
            $table->boolean('actual')->default(TRUE);
            $table->string('personal_number', 8)->nullable();
            $table->string('phone',50)->nullable();
            $table->integer('person_id');
            $table->integer('node_id');
            $table->timestamps();
        });
        Schema::table('officers', function (Blueprint $table){
            $table->foreign('person_id')->references('id')->on('people')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('officers', function($table){
            $table->dropForeign(['person_id']);
        });
        Schema::dropIfExists('officers');
    }
}
