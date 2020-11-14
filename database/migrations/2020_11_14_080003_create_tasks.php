<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('name');
            $table->text('description')->nullable();
            $table->bigInteger('user_id', false, true);
            $table->date('start_date')->nullable();
            $table->dateTime('notification')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->integer('sort')->default(500);
            $table->boolean('is_complete')->default(false);
            $table->dateTime('completion_date')->nullable();
            $table->string('completion_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
