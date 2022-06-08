<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('senders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();//отправитель личность
            $table->string('phone', 100)->nullable();
            $table->integer('organization_id');
            $table->timestamps();
        });
        Schema::table('senders', function (Blueprint $table){
            $table->foreign('organization_id')->references('id')->on('officers')
                ->onUpdate('cascade')
                ->onDelete('set null');//?
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('senders', function($table){
            $table->dropForeign(['organization_id']);
        });
        Schema::dropIfExists('senders');
    }
}
