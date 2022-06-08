<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();//получатель личность
            $table->string('phone', 100)->nullable();
            $table->integer('organization_id');
            $table->timestamps();
        });
        Schema::table('recipients', function (Blueprint $table){
            $table->foreign('organization_id')->references('id')->on('organizations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
        Schema::table('exemplars', function (Blueprint $table){
            $table->foreign('recipient_id')->references('id')->on('recipients')
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
        Schema::table('exemplars', function($table){
            $table->dropForeign(['recipient_id']);
        });
        Schema::dropIfExists('recipients');
    }
}
