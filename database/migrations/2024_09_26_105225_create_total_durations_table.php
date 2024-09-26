<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('total_durations', function (Blueprint $table) {
            $table->id();
            $table->integer('plan');
            $table->integer('actual');
            $table->unsignedBigInteger('gantt_chart_id');
            $table->foreign('gantt_chart_id')->references('id')->on('gantt_charts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('total_durations');
    }
};
