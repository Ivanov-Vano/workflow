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
        Schema::create('outgoings', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->date('date');
            $table->bigInteger('option_id')->nullable();
            $table->bigInteger('organization_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('page_count')->nullable();
            $table->integer('page_start')->nullable();
            $table->enum('confidential', ['ns', 'dsp'])->default('ns');
            $table->integer('exemplar_count')->default('1');
            $table->string('image')->nullable();
            $table->bigInteger('registry_id')->nullable();
            $table->integer('registry_part')->nullable();
            $table->string('note')->nullable();
            $table->bigInteger('officer_id')->nullable();
            $table->bigInteger('created_who')->nullable();
            $table->bigInteger('updated_who')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('option_id')->references('id')->on('options')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('organization_id')->references('id')->on('organizations')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('registry_id')->references('id')->on('registries')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('officer_id')->references('id')->on('officers')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('created_who')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('updated_who')->references('id')->on('users')
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
        Schema::dropIfExists('outgoings');
    }
};
