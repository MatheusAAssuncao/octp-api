<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 80);
            $table->string('password', 100);
            $table->string('temp_password', 100)->nullable();
            $table->string('cpf', 11)->nullable();
            $table->string('cnpj', 14)->nullable();
            $table->string('phone', 13)->nullable();
            $table->integer('photo')->nullable();
            $table->string('media_facebook', 50)->nullable();
            $table->string('media_instagram', 20)->nullable();
            $table->string('media_whatsapp', 20)->nullable();
            $table->string('terms_use', 255)->nullable();
            $table->char('status', 1)->default('A')->comment('A - Active, I - Inative');
            $table->char('genre', 1)->default('O')->comment('M - Masculino, F - Feminino, O - Outro');
            $table->date('dt_born')->nullable();
            $table->char('type', 1)->default('T')->comment('T - Teacher, S - Student');
            $table->string('token', 500)->nullable();
            $table->timestamps();

            $table->unique('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
