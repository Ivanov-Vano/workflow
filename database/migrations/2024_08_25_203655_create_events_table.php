<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('type')->comment('наименование события');
            $table->string('name');
            $table->timestamp('take_place_at')->comment('время и дата проведения мероприятия');
            $table->foreignId('organization_id')->constrained()->onDelete('cascade');
            $table->string('place')->comment('место проведения');
            $table->timestamp('participants_before_at')->comment('время и дата подача участников')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
