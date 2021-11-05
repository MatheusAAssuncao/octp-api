<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExerciseSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercise_series', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_exercise_detail')->constrained('exercise_details')->onDelete('cascade');
            $table->integer('charge')->nullable();
            $table->integer('repetition');
            $table->integer('order');
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
        Schema::dropIfExists('exercise_series');
    }
}
