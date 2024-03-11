<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number', 10);
            $table->string('name');
            $table->integer('part')->nullable();
            $table->text('description')->nullable();
            $table->year('year')->nullable();
            $table->integer('order')->nullable();
            $table->timestamps();
        });
        Schema::table('documents', function (Blueprint $table) {
            $table->integer('registry_id')->nullable();
            $table->foreign('registry_id')->references('id')->on('registries')
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
        Schema::table('documents', function($table){
            $table->dropForeign(['registry_id']);
            $table->dropColumn('registry_id');
        });
        Schema::dropIfExists('registries');
    }
}
