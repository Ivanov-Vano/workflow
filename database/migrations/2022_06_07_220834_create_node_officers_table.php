<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodeOfficersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('node_officers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('officer_id');
            $table->integer('node_id');
            $table->boolean('actual')->default(TRUE);
            $table->timestamps();
        });
        Schema::table('node_officers', function (Blueprint $table){
            $table->foreign('officer_id')->references('id')->on('officers')
                ->onUpdate('cascade')
                ->onDelete('set null');//?
            $table->foreign('node_id')->references('id')->on('nodes')
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
        Schema::table('node_officers', function($table){
            $table->dropForeign(['node_id']);
            $table->dropForeign(['officer_id']);
        });
        Schema::dropIfExists('node_officers');
    }
}
