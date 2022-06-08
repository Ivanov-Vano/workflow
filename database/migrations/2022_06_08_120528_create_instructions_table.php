<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('text')->nullable();
            $table->date('deadline')->nullable();
            $table->timestamp('viewing')->nullable();
            $table->date('implementation')->nullable();// если не пустое, то исполнено
            $table->boolean('personally')->default(FALSE)->nullable();
            $table->integer('node_id');// исполнитель
            $table->integer('officer_id');//кто отдал
            $table->timestamps();
        });
        Schema::table('instructions', function (Blueprint $table){
            $table->foreign('node_id')->references('id')->on('nodes')
                ->onUpdate('cascade')
                ->onDelete('set null');//?
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
        Schema::table('instructions', function($table){
            $table->dropForeign(['officer_id']);
            $table->dropForeign(['node_id']);
        });
        Schema::dropIfExists('instructions');
    }
}
