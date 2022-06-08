<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commanders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('short_name', 100)->unique();
            $table->timestamps();
        });
        // ссылка на чей приказ
        Schema::table('decree_documents', function (Blueprint $table){
            $table->integer('commander_id');
            $table->foreign('commander_id')->references('id')->on('commanders')
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
        Schema::table('decree_documents', function($table){
            $table->dropForeign(['commander_id']);
            $table->dropColumn(['commander_id']);
        });
        Schema::dropIfExists('commanders');
    }
}
