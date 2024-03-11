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
        Schema::create('incomings', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->date('date');
            $table->string('name');
            $table->string('sender_number')->nullable();
            $table->date('sender_date')->nullable();
            $table->string('sender_name')->nullable();
            $table->string('sender_phone')->nullable();
            $table->bigInteger('organization_id');
            $table->bigInteger('option_id')->nullable();
            $table->text('description')->nullable();
            $table->integer('page_count')->nullable();
            $table->integer('page_start')->nullable();
            $table->enum('confidential', ['ns', 'dsp'])->default('ns');
            $table->integer('exemplar_count')->default('1');
            $table->string('image')->nullable();
            $table->bigInteger('registry_id')->nullable();
            $table->string('resolution')->nullable();
            $table->date('deadline')->nullable();
            $table->date('completed_at')->nullable();
            $table->bigInteger('officer_id')->nullable();
            $table->boolean('is_complete')->nullable();
            $table->integer('registry_part')->nullable();
            $table->enum('importance',
                ['vies-ma-srochno', 'vybrat-datu', 'obychnaia', 'opierativno', 'srochno'])
                ->nullable();
            $table->string('result_text')->nullable();
            $table->bigInteger('whose_resolution')->nullable();
            $table->bigInteger('created_who')->nullable();
            $table->bigInteger('updated_who')->nullable();
            $table->bigInteger('sign_completed_who')->nullable();
            $table->timestamp('sign_completed_at')->nullable();
            $table->boolean('is_internal')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('organization_id')->references('id')->on('organizations')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('option_id')->references('id')->on('options')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('registry_id')->references('id')->on('registries')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('officer_id')->references('id')->on('officers')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('whose_resolution')->references('id')->on('officers')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('created_who')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('updated_who')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('sign_completed_who')->references('id')->on('users')
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
        Schema::dropIfExists('incomings');
    }
};
