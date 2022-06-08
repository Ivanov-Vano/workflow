<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternalDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid');
            $table->string('number');
            $table->date('date');
            $table->string('name');
            $table->text('summary')->nullable();
            $table->integer('page_count')->nullable();
            $table->enum('confidential', ['нс', 'дсп'])->nullable();
            $table->date('make')->nullable(); // дата создания документа
            $table->string('image')->nullable();
            $table->integer('officer_id');//исполнитель
            $table->integer('document_type_id')->nullable();
            $table->timestamps();
        });
        Schema::table('internal_documents', function (Blueprint $table){
            $table->foreign('officer_id')->references('id')->on('officers')
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
        Schema::table('internal_documents', function($table){
            $table->dropForeign(['document_type_id']);
            $table->dropForeign(['officer_id']);
        });
        Schema::dropIfExists('internal_documents');
    }
}
