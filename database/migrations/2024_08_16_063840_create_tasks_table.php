<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->date('due_date')->nullable();
            $table->string('assigned_by')->nullable();
            $table->unsignedBigInteger('user_id'); // This references the 'users' table for task owner.
            $table->unsignedBigInteger('project_id'); // This references the 'projects' table.
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->unsignedBigInteger('priority_id');
            $table->foreign('priority_id')->references('id')->on('priorities')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
