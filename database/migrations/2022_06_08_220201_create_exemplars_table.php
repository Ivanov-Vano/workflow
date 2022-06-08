<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExemplarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exemplars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid');
            $table->integer('number');
            $table->integer('page_start')->nullable();//в дело
            $table->integer('case_id')->nullable();//в дело
            $table->integer('recipient_id')->nullable();//получатель
            $table->timestamps();
        });
        Schema::table('exemplars', function (Blueprint $table){
            $table->foreign('case_id')->references('id')->on('cases')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exemplars', function($table){
            $table->dropForeign(['case_id']);
        });
        Schema::dropIfExists('exemplars');
    }
}
