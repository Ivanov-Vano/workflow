<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workbooks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->date('registered_at');
            $table->string('name')->nullable();
            $table->integer('page_count')->nullable();
            $table->enum('confidential', ['НС', 'ДСП'])->default('НС');
            $table->date('destroyed_at')->nullable();
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
        Schema::table('workbooks', function($table){
            $table->dropForeign(['document_id']);
        });
        Schema::dropIfExists('workbooks');
    }
}
