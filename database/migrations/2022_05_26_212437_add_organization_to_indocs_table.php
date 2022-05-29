<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrganizationToIndocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indocs',function (Blueprint $table) {
            $table->integer('org_id')->unsigned();
            $table->foreign('org_id')
                ->references('id')->on('organizations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('indocs', function (Blueprint $table) {
            $table->dropForeign('indocs_org_id_foreign');
            $table->dropColumn('org_id');
        });
    }
}
