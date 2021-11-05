<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40);
            $table->string('description', 150)->nullable();
            $table->foreignId('id_muscle_group')->constrained('muscle_groups');
            $table->foreignId('id_equipment')->constrained('equipments');
            $table->foreignId('id_user')->nullable()->constrained('user');
            $table->string('url', 200)->nullable();
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
        Schema::dropIfExists('exercises');
    }
}
