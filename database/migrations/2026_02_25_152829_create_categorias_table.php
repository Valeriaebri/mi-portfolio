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
        Schema::create('categorias', function (Blueprint $table) {
           $table->id();
           $table->string('nombre');
           $table->string('slug')->nullable();//para q la url sea  crema-facial
           $table->text('descripcion')->nullable();
           $table->boolean('activo')->default(true);//activar o desactivar una categoría
           $table->timestamps();//Crea automáticamente dos columnas:created_at → fecha de creación +updated_at → fecha de última actualización


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
