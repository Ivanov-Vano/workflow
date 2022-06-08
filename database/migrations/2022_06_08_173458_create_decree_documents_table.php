<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDecreeDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decree_documents', function (Blueprint $table) {
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
            $table->enum('type', ['Приказ', 'Приказание', 'Приказ МО'])->nullable();
            $table->integer('officer_id');//исполнитель
            $table->timestamps();
        });
        Schema::table('decree_documents', function (Blueprint $table){
            $table->foreign('officer_id')->references('id')->on('officers')
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
        Schema::table('decree_documents', function($table){
            $table->dropForeign(['officer_id']);
        });
        Schema::dropIfExists('decree_documents');
    }
}
