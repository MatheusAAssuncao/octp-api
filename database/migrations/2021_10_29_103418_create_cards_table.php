<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->string('description', 100)->nullable();
            $table->foreignId('id_teacher_student')->nullable()->constrained('teacher_students');
            $table->foreignId('id_user')->nullable()->constrained('user');
            $table->date('dt_end')->nullable();
            $table->integer('times')->nullable();
            $table->char('status', 1)->default('A')->comment('A - Active, I - Inative');
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
        Schema::dropIfExists('cards');
    }
}
