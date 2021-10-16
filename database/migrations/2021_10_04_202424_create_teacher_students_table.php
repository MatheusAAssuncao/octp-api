<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_teacher')->constrained('user');
            $table->foreignId('id_student')->constrained('user');
            $table->char('type_student', 1)->comment('P - Presencial, O - Online');
            $table->char('type_contract', 1)->comment('M - Mensal, T - Trimestral, S - Semestral');
            $table->tinyText('notes')->nullable();
            $table->foreignId('id_required_anamnesis')->nullable()->constrained('files');
            $table->foreignId('id_uploaded_anamnesis')->nullable()->constrained('files');
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
        Schema::dropIfExists('teacher_students');
    }
}
