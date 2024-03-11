<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficerWorkbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('officer_workbook', function (Blueprint $table) {
            $table->increments('id');
            $table->date('received_at');
            $table->date('returned_at')->nullable();
            $table->integer('officer_id');
            $table->integer('workbook_id');
            $table->string('note')->nullable();// примечание
            $table->timestamps();
        });
        Schema::table('officer_workbook', function (Blueprint $table){
            $table->foreign('officer_id')->references('id')->on('officers')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('workbook_id')->references('id')->on('workbooks')
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
        Schema::table('officer_workbook', function($table){
            $table->dropForeign(['workbook_id']);
            $table->dropForeign(['officer_id']);
        });
        Schema::dropIfExists('officer_workbook');
    }
}
