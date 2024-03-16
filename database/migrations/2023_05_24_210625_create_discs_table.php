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
        Schema::create('discs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('confidential', ['ns', 'dsp'])->default('ns');
            $table->date('destroyed_at')->nullable();
            $table->integer('type_id')->nullable();
            $table->foreign('type_id')->references('id')->on('media_types')
                ->onDelete('SET NULL');
            $table->integer('registry_id')->nullable();
            $table->foreign('registry_id')->references('id')->on('registries')
                ->onDelete('SET NULL');
            $table->string('number')->nullable();
            $table->date('date')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('discs');
    }
};
