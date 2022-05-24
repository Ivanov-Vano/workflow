<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExemplarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exemplars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('num');
            $table->string('note');
            $table->integer('indoc_id')->unsigned();
            $table->foreign('indoc_id')
                    ->references('id')->on('indocs')
                    ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exemplars');
    }
}
