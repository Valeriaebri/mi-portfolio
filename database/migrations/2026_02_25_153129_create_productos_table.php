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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('slug')->unique();//versión del nombre apta para URL->crema-facial-hidratante
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 10, 2);
            $table->text('modo_empleo')->nullable();
            $table->text('ingredientes_inci')->nullable();
            $table->boolean('destacado')->default(false);//ndica si el producto aparece como destacado en la web.
            $table->boolean('activo')->default(true);//Indica si el producto está disponible.

            $table->foreignId('categoria_id')// crea una columna que guarda el id de la categoría.
                ->constrained('categorias')//esta columna está relacionada con la tabla categorias → categorias.id
                 ->onDelete('cascade');// si se borra una categoría, se borran automáticamente todos sus productos.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
