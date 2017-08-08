<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('birth')->nullable();
            $table->string('avatar')->nullable();
            $table->text('content')->nullable();
            $table->bigInteger('area')->nullable()->comment('区域ID');
            $table->bigInteger('department')->nullable()->comment('部门ID');
            $table->tinyInteger('sex')->nullable()->comment('性别');
            $table->tinyInteger ( 'status' )->comment ( '状态' )->default ( 1 );
            $table->rememberToken();
            $table->dateTime ( 'deleted_at' )->nullable ()->comment ( '软删除' );
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
        Schema::dropIfExists('users');
    }
}
