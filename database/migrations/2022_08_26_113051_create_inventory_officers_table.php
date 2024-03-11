<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryOfficersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_officer', function (Blueprint $table) {
            $table->increments('id');
            $table->date('received_at');
            $table->integer('inventory_id');
            $table->integer('officer_id');
            $table->timestamps();
        });
        Schema::table('inventory_officer', function (Blueprint $table){
            $table->foreign('inventory_id')->references('id')->on('inventories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('officer_id')->references('id')->on('officers')
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
        Schema::table('inventory_officer', function($table){
            $table->dropForeign(['inventory_id']);
            $table->dropForeign(['officer_id']);
        });
        Schema::dropIfExists('inventory_officer');
    }
}
