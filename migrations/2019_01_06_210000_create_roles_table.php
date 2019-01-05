<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('users', function(Blueprint $table){
            $table->unsignedInteger('role_id')->nullable();
        });

        Schema::table('users', function(Blueprint $table){
            $table->foreign('role_id')->references('id')->on('roles');
        });

    }

    public function down()
    {
        if(config('database.default') != 'testing'){
            Schema::table('users', function(Blueprint $table){
                $table->dropForeign('role_id');
            });
            Schema::table('users', function(Blueprint $table){
                $table->dropColumn('role_id');
            });
        }

        Schema::drop('roles');
    }
}