<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indocs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('num');
            $table->timestamp('date');
            $table->string('outnum');
            $table->timestamp('outdate');
            $table->string('sender');
            $table->string('text');
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
        Schema::dropIfExists('indocs');
    }
}
