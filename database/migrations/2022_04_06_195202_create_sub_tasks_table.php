<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->datetime('due_date')->nullable();
            $table->boolean('removed');
            $table->boolean('status');

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
        Schema::dropIfExists('sub_tasks');
    }
}
