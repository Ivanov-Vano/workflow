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
        Schema::create('decree_node', function (Blueprint $table) {
            $table->id();
            $table->foreignId('node_id')->constrained()->onDelete('cascade');
            $table->foreignId('decree_id')->constrained()->onDelete('cascade');
            $table->boolean('is_main')->default(FALSE)->nullable();
            $table->boolean('is_personal')->default(FALSE)->nullable();
            $table->string('comment')->nullable();// комментарии исполнителя
            $table->timestamp('viewed_at')->nullable();// ознакомление исполнителем
            $table->string('report_text')->nullable();// текст доклада о выполнении
            $table->string('report')->nullable();// приложенный файл с докладом
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
        Schema::dropIfExists('decree_node');
    }
};
