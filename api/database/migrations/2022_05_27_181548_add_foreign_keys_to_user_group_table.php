<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUserGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_group', function (Blueprint $table) {
            $table->foreign(['id_group'], 'FK_group')->references(['id'])->on('group')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_user'], 'FK_user')->references(['id'])->on('user')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_group', function (Blueprint $table) {
            $table->dropForeign('FK_group');
            $table->dropForeign('FK_user');
        });
    }
}
