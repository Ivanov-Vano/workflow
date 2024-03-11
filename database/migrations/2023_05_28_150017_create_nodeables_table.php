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
        Schema::create('nodeables', function (Blueprint $table) {
            $table->foreignId('node_id')->onDelete('cascade');
            $table->morphs('nodeable');
            $table->timestamp('viewed_at')->nullable();// просмотрено ответственными
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
        Schema::dropIfExists('nodeables');
    }
};
