<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExerciseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercise_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_exercise')->constrained('exercises');
            $table->foreignId('id_exercise_group')->constrained('exercise_groups')->onDelete('cascade');
            $table->foreignId('id_equipment')->constrained('equipments');
            $table->string('url', 200)->nullable();
            $table->string('repetition_type', 25);
            $table->string('charge_type', 25);
            $table->integer('series_interval');
            $table->string('notes', 250)->nullable();
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
        Schema::dropIfExists('exercise_details');
    }
}
