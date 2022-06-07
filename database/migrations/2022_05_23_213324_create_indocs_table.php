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
            $table->string('num_out');
            $table->timestamp('date_out');
            $table->string('name');
            $table->text('summary');
            $table->integer('count_page');
            $table->integer('resolution_chief_id')->nullable(false);
            $table->text('note');
            $table->string('confidential');
            $table->string('image');
            $table->text('summary');
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
