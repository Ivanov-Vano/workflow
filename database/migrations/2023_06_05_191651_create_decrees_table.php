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
    public function up(): void
    {
        Schema::create('decrees', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->date('date');
            $table->enum('type', ['Приказ', 'Приказание', 'Прочие приказы'])
                ->default('Приказ');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->bigInteger('incoming_id')->nullable();
            $table->enum('confidential', ['ns', 'dsp'])->default('ns');
            $table->integer('exemplar_count')->default('1');
            $table->integer('page_count')->nullable();
            $table->bigInteger('registry_id')->nullable();
            $table->integer('registry_part')->nullable();
            $table->integer('page_start')->nullable();
            $table->bigInteger('commander_id')->nullable();
            $table->bigInteger('created_who')->nullable();
            $table->bigInteger('updated_who')->nullable();
            $table->bigInteger('signed_who')->nullable();
            $table->foreign('incoming_id')->references('id')->on('incomings')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('registry_id')->references('id')->on('registries')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('commander_id')->references('id')->on('commanders')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('created_who')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('updated_who')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('signed_who')->references('id')->on('officers')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('decrees');
    }
};
