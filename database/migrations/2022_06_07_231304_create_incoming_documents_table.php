<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomingDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incoming_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid');
            $table->string('number');
            $table->date('date');
            $table->string('number_sender')->nullable();
            $table->date('date_sender')->nullable();
            $table->string('name');
            $table->text('summary')->nullable();
            $table->integer('page_count')->nullable();
            $table->enum('confidential', ['нс', 'дсп'])->nullable();
            $table->integer('sender_id');
            $table->integer('document_type_id')->nullable();
            $table->timestamps();
        });
        Schema::table('incoming_documents', function (Blueprint $table){
            $table->foreign('sender_id')->references('id')->on('senders')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('document_type_id')->references('id')->on('document_types')
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
        Schema::table('incoming_documents', function($table){
            $table->dropForeign(['document_type_id']);
            $table->dropForeign(['sender_id']);
        });
        Schema::dropIfExists('incoming_documents');
    }
}
