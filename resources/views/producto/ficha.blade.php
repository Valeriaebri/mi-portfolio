@extends('layouts.master')

@section('content')

    <section class="producto-ficha" style="margin-top:30px;">

        {{-- CONTENEDOR PRINCIPAL --}}
        <div style="
        max-width:1000px;
        margin:0 auto;
        display:grid;
        grid-template-columns: 360px 1fr;
        gap:40px;
        align-items:start;
    ">

            {{-- IMAGEN --}}
            <div style="text-align:center;">
                <img src="/img/productos/{{ $producto->imagen }}"
                     alt="{{ $producto->nombre }}"
                     style="width:100%; max-width:320px; border-radius:14px; box-shadow:0 4px 12px rgba(0,0,0,0.1);">
            </div>

            {{-- INFO PRINCIPAL --}}
            <div>

                <h1 style="font-size:28px; font-weight:700; margin-bottom:6px;">
                    {{ $producto->nombre }}
                </h1>

                <p style="font-size:20px; font-weight:700; color:burlywood; margin-bottom:12px;">
                    {{ $producto->precio }} €
                </p>

                <p style="font-size:15px; line-height:1.5; margin-bottom:18px; max-width:90%;">
                    {{ $producto->descripcion }}
                </p>

                {{-- BOTÓN --}}
                <a href="/carrito/add/{{ $producto->id }}"
                   class="btn btn-primary"
                   style="padding:10px 18px; font-size:15px; border-radius:8px; display:inline-block; margin-bottom:25px;">
                    Añadir al carrito
                </a>

                {{-- MODO DE EMPLEO + INCI EN BLOQUE COMPACTO --}}
                <div style="
                background:white;
                padding:18px 20px;
                border-radius:12px;
                box-shadow:0 3px 10px rgba(0,0,0,0.06);
                font-size:14px;
                line-height:1.5;
                max-width:90%;
            ">

                    @if($producto->modo_empleo)
                        <h3 style="font-size:17px; margin-bottom:6px;">Modo de empleo</h3>
                        <p style="margin-bottom:12px;">{{ $producto->modo_empleo }}</p>
                    @endif

                    @if($producto->ingredientes_inci)
                        <h3 style="font-size:17px; margin-bottom:6px;">Ingredientes (INCI)</h3>
                        <p>{{ $producto->ingredientes_inci }}</p>
                    @endif

                </div>

            </div>

        </div>


        {{-- PRODUCTOS RELACIONADOS --}}
        @php
            // 1. Intentar obtener relacionados de la misma categoría
            $relacionados = \App\Models\Producto::where('categoria_id', $producto->categoria_id)
                ->where('id', '!=', $producto->id)
                ->take(4)
                ->get();

            // 2. Si hay menos de 4, rellenar con productos aleatorios
            if ($relacionados->count() < 4) {
                $faltan = 4 - $relacionados->count();

                $extra = \App\Models\Producto::where('id', '!=', $producto->id)
                    ->where('categoria_id', '!=', $producto->categoria_id)
                    ->inRandomOrder()
                    ->take($faltan)
                    ->get();

                $relacionados = $relacionados->merge($extra);
            }
        @endphp

        <div class="producto-bloque" style="max-width:1000px; margin:50px auto 0;">
            <h2 style="font-size:22px; margin-bottom:20px; text-align:center;">
                También te puede interesar
            </h2>

            <div class="grid-productos" style="gap:20px;">
                @foreach($relacionados as $relacionado)
                    <div class="card-producto" style="padding:15px; border-radius:12px;">
                        <img src="/img/productos/{{ $relacionado->imagen }}"
                             alt="{{ $relacionado->nombre }}"
                             style="height:180px; object-fit:contain;">

                        <h3 style="margin-top:8px; font-size:16px;">{{ $relacionado->nombre }}</h3>
                        <p class="precio" style="margin-bottom:8px; font-size:15px;">
                            {{ $relacionado->precio }} €
                        </p>

                        <a href="/producto/{{ $relacionado->slug }}"
                           class="btn btn-primary btn-small"
                           style="padding:6px 12px; border-radius:6px; font-size:13px;">
                            Ver producto
                        </a>
                    </div>
                @endforeach
            </div>
        </div>


    </section>

@endsection
