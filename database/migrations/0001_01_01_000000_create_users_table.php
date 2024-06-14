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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('tarifas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->integer('num_clases');
            $table->timestamps();
        });

        Schema::create('aulas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('capacidad');
            $table->timestamps();
        });

        Schema::create('trabajos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('apellido_1')->nullable();
            $table->string('apellido_2')->nullable();
            $table->string('email')->unique();
            $table->string('dni')->unique(); // DNI ahora es obligatorio y único
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('id_tarifa')->nullable();
            $table->integer('cupos_clases')->nullable()->default(0);
            $table->foreignId('id_rol')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_tarifa')->references('id')->on('tarifas');
            $table->foreign('id_rol')->references('id')->on('roles');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('clases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_aula')->constrained('aulas');
            $table->foreignId('id_trabajo')->constrained('trabajos');
            $table->date('fecha');
            $table->time('hora');
            $table->timestamps();
        });

        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_clase')->constrained('clases');
            $table->foreignId('id_usuario')->constrained('users');
            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('reservas');
        Schema::dropIfExists('clases');
        Schema::dropIfExists('trabajos');
        Schema::dropIfExists('aulas');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('tarifas');
    }
};