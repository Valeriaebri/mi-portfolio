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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
         $table->string('apellidos')->nullable();
         $table->string('nif')->nullable();
         $table->string('email')->unique();
         $table->string('password');
         $table->enum('role', ['admin', 'cliente'])->default('cliente');
         $table->integer('total_pedidos')->default(0);
         $table->string('foto')->nullable();
         $table->rememberToken(); // para el login
         $table->timestamps();
        });

        // gestionar los enlaces de “he olvidado mi contraseña”.
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); //email como primary key
            $table->string('token');//Aquí se guarda el token que se envía al usuario para resetear la contraseña
            $table->timestamp('created_at')->nullable();//Fecha y hora en la que se creó el token. Puede ser nula.
        });

        //l guarda las sesiones de los usuarios cuando usas SESSION_DRIVER=database
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();//crea una columna llamada user_id dentro de la tabla
            //  sessions->guardar aquí el ID del usuario que está usando esta sesión. Index es para buscarlo antes
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();//Texto con la información del navegador/dispositivo, opcional
            $table->longText('payload');//contenido de la sesión (datos
            $table->integer('last_activity')->index();//Marca de tiempo (timestamp en entero) de la última actividad.
           // Tiene índice para poder limpiar sesiones antiguas más rápido.
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
    }
};
