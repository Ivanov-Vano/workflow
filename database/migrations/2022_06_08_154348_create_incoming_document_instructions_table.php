<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomingDocumentInstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incoming_document_instructions', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('main')->default(FALSE)->nullable();// должна быть проверка: true для одного indoc_id
            $table->integer('instruction_id');// указание
            $table->integer('incoming_document_id');// входящий документ
            $table->timestamps();
        });
        Schema::table('incoming_document_instructions', function (Blueprint $table){
            $table->foreign('instruction_id')->references('id')->on('instructions')
                ->onUpdate('cascade')
                ->onDelete('set null');//?
            $table->foreign('incoming_document_id')->references('id')->on('incoming_documents')
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
        Schema::table('incoming_document_instructions', function($table){
            $table->dropForeign(['incoming_document_id']);
            $table->dropForeign(['instruction_id']);
        });
        Schema::dropIfExists('incoming_document_instructions');
    }
}
