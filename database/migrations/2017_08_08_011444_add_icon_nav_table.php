<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIconNavTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('navigations', function (Blueprint $table) {
            $table->string ( 'icon' )->comment ( '图标' )->nullable();
            $table->string ( 'rank' )->comment ( '排序' )->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('navigations', function (Blueprint $table) {
            //
        });
    }
}
