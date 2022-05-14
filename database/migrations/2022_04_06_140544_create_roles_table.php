<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();

            $table->BigInteger('task_id')->unsigned();
            $table->foreign('task_id')->references('id')->on('tasks');

            $table->BigInteger('phase_id')->unsigned()->nullable();
            $table->foreign('phase_id')->references('id')->on('phases');

            $table->BigInteger('project_id')->unsigned()->nullable();
            $table->foreign('project_id')->references('id')->on('projects');

            $table->BigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
