<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->unique();
            $table->string('name_short')->unique();
            $table->string('number')->nullable(); // код подразделения
            $table->integer('sort')->default(1);
            $table->boolean('actual')->default(TRUE);
            $table->integer('parent_id')->nullable()->unsigned();
            $table->timestamps();
        });
        Schema::table('nodes', function (Blueprint $table){
            $table->foreign('parent_id')->references('id')->on('nodes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nodes', function($table){
            $table->dropForeign(['parent_id']);
        });
        Schema::dropIfExists('nodes');
    }
}
