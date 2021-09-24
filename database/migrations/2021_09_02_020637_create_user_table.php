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
            $table->foreignId('photo')->nullable()->constrained('files');
            $table->string('media_facebook', 50)->nullable();
            $table->string('media_instagram', 20)->nullable();
            $table->string('media_whatsapp', 20)->nullable();
            $table->string('terms_use', 255)->nullable();
            $table->foreignId('id_tems_use')->nullable()->constrained('files');
            $table->char('status', 1)->default('A');
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
