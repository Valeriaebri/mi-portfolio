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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                 ->OnDelete('cascade');

            $table->enum('estado', ['pendiente', 'aceptado', 'cancelado'])
                ->default('pendiente');

            $table->enum('tipo',['normal','regalo'])
                ->default('normal');

            $table->string('tipo_envio')->nullable();
            $table->string('forma_pago')->nullable();
            $table->string('transaccion')->nullable();
            $table->decimal('total',10,2)->default(0);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
