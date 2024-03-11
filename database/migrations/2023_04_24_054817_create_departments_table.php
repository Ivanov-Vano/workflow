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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->unique();
            $table->string('name_short')->unique();
            $table->string('number')->nullable(); // код подразделения
            $table->integer('sort')->default(1);
            $table->boolean('actual')->default(TRUE);
            $table->integer('parent_id')->nullable()->unsigned();
            $table->timestamps();
        });
        Schema::table('officers', function (Blueprint $table){
            $table->foreignId('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments');
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
            $table->dropForeign(['department_id']);
        });
        Schema::dropIfExists('departments');
    }
};
