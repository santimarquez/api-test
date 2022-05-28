<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRolePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('role_permission', function (Blueprint $table) {
            $table->foreign(['id_permission'], 'FK_permission_id')->references(['id'])->on('permission_list')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_role'], 'FK_role_id')->references(['id'])->on('role')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('role_permission', function (Blueprint $table) {
            $table->dropForeign('FK_permission_id');
            $table->dropForeign('FK_role_id');
        });
    }
}
