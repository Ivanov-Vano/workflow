<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('short_name', 100)->unique();;
            $table->timestamps();
        });
        Schema::table('officers', function (Blueprint $table){
            $table->integer('rank_id')->nullable();
            $table->foreign('rank_id')->references('id')->on('ranks')
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
        Schema::table('officers', function($table){
            $table->dropForeign(['rank_id']);
            $table->dropColumn('rank_id');
        });
        Schema::dropIfExists('ranks');
    }
}
