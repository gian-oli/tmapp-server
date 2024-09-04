<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->date('deadline');
            $table->date('finished_at')->nullable();
            $table->unsignedBigInteger('user_id'); // This references the project manager.
            $table->unsignedBigInteger('priority_id'); // This references the priority level.
            $table->unsignedBigInteger('status_id'); // This references the status of project.
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('priority_id')->references('id')->on('priorities')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
