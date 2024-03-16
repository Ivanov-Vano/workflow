<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('number', 10);
            $table->date('registered_at');
            $table->integer('part')->nullable();
            $table->string('note')->nullable();
            $table->text('description')->nullable();
            $table->integer('order')->nullable();
            $table->timestamps();
        });
        Schema::table('workbooks', function (Blueprint $table) {
            $table->integer('book_id');
            $table->foreign('book_id')->references('id')->on('books')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
        Schema::table('inventories', function (Blueprint $table) {
            $table->integer('book_id');
            $table->foreign('book_id')->references('id')->on('books')
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
        Schema::table('workbooks', function($table){
            $table->dropForeign(['book_id']);
        });
        Schema::table('inventories', function($table){
            $table->dropForeign(['book_id']);
        });
        Schema::dropIfExists('books');
    }
};
