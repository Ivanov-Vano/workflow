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
        Schema::create('disc_officer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('disc_id')->constrained()->onDelete('cascade');
            $table->foreignId('officer_id')->constrained()->onDelete('cascade');
            $table->date('received_at');// получен диск
            $table->date('returned_at')->nullable();// возвращен диск
            $table->string('note')->nullable();// примечание
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
        Schema::dropIfExists('disc_officer');
    }
};
