@extends('layouts.master')

@section('content')

    @php
        /* COLORES POR PRODUCTO */
        $colores = [
            'Elton Lemon'   => '#ffd800',
            'Grape Kelly'   => '#f840ce',
            'Pina Turner'   => '#eb7030',
            'Dua Lime'      => '#cdf112',
            'Kiwi Minogue'  => '#9ead50',
            'Cactus Perry'  => '#55abe3',
            'Mango Cyrus'   => '#e85067',
            'Mad Orange'    => '#fe7d33',
        ];

        $color = $colores[$producto->nombre] ?? '#caa77a';
        $colorFondo = $color . '22';

        /* ICONOS ALEATORIOS (SOLO ESTOS) */
        $iconos = [
            'antioxidante-negativo.png',
            'exfolia-negativo.png',
            'friendly-negativo.png',
            'hidrata-negativo.png',
            'ilumina-negativo.png',
            'lifting-negativo.png',
            'limpia-negativo.png',
            'nutre-negativo.png',
            'regenera-negativo.png',
            'regula-negativo.png',
            'regulaph-negativo.png',
            'rejuvenece-negativo.png',
            'sostenible-negativo.png',
            'spf20-negativo.png',
            'textura-negativo.png',
            'vegano.png',
        ];

        shuffle($iconos);
        $iconos = array_slice($iconos, 0, 3);
    @endphp

    <section class="producto-ficha" style="margin-top:40px;">

        <div style="
        max-width:1100px;
        margin:0 auto;
        display:grid;
        grid-template-columns: 380px 1fr;
        gap:50px;
        align-items:start;
    ">

            {{-- IMAGEN + ICONOS --}}
            <div>

                {{-- IMAGEN CON FONDO SUAVE --}}
                <div style="
                background: {{ $colorFondo }};
                padding: 30px;
                border-radius: 20px;
                display: flex;
                justify-content: center;
                align-items: center;
                box-shadow: 0 4px 14px rgba(0,0,0,0.08);
                margin-bottom: 25px;
            ">
                    <img src="/img/productos/{{ $producto->imagen }}"
                         alt="{{ $producto->nombre }}"
                         style="
                        width:100%;
                        max-width:330px;
                        object-fit:contain;
                        border-radius:16px;
                        background: transparent !important;
                     ">
                </div>

                {{-- ICONOS ALEATORIOS (LOS BUENOS) --}}
                <div style="
                display:flex;
                justify-content:center;
                gap:22px;
                margin-top:10px;
            ">
                    @foreach($iconos as $icono)
                        <div style="
                        width:80px;
                        height:80px;
                         background: {{ $color }}99; /* MÁS VIVO */
                        border-radius:18px;
                        display:flex;
                        justify-content:center;
                        align-items:center;
                        box-shadow:0 3px 10px rgba(0,0,0,0.08);
                    ">
                            <img src="/img/iconos/{{ $icono }}" style="width:42px; height:42px; object-fit:contain;">
                        </div>
                    @endforeach
                </div>

            </div>

            {{-- INFORMACIÓN --}}
            <div>

                <h1 style="font-size:34px; font-weight:800; margin-bottom:10px; color:{{ $color }};">
                    {{ $producto->nombre }}
                </h1>

                <p style="font-size:26px; font-weight:700; margin-bottom:18px; color:{{ $color }};">
                    {{ $producto->precio }} €
                </p>

                <p style="font-size:16px; line-height:1.6; margin-bottom:25px; max-width:90%;">
                    {{ $producto->descripcion }}
                </p>

                <a href="/carrito/add/{{ $producto->id }}"
                   style="
                    padding:12px 22px;
                    font-size:16px;
                    border-radius:10px;
                    display:inline-block;
                    margin-bottom:30px;
                    background:{{ $color }};
                    color:white;
                    font-weight:700;
                    text-decoration:none;
               ">
                    Añadir al carrito
                </a>

                <div style="
                background:white;
                padding:22px 24px;
                border-radius:14px;
                box-shadow:0 3px 12px rgba(0,0,0,0.06);
                font-size:15px;
                line-height:1.6;
                max-width:90%;
            ">

                    @if($producto->modo_empleo)
                        <h3 style="font-size:18px; margin-bottom:6px; font-weight:700;">Modo de empleo</h3>
                        <p style="margin-bottom:14px;">{{ $producto->modo_empleo }}</p>
                    @endif

                    @if($producto->ingredientes_inci)
                        <h3 style="font-size:18px; margin-bottom:6px; font-weight:700;">Ingredientes (INCI)</h3>
                        <p>{{ $producto->ingredientes_inci }}</p>
                    @endif

                </div>

            </div>

        </div>

        {{-- PRODUCTOS RELACIONADOS --}}
        @php
            $relacionados = \App\Models\Producto::where('categoria_id', $producto->categoria_id)
                ->where('id', '!=', $producto->id)
                ->take(4)
                ->get();

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

        <div style="max-width:1100px; margin:60px auto 0;">
            <h2 style="font-size:24px; margin-bottom:25px; text-align:center; font-weight:800;">
                También te puede interesar
            </h2>

            <div class="grid-productos" style="gap:25px;">
                @foreach($relacionados as $relacionado)
                    <div class="card-producto" style="padding:18px; border-radius:14px; background:white; box-shadow:0 4px 12px rgba(0,0,0,0.06); text-align:center;">
                        <img src="/img/productos/{{ $relacionado->imagen }}"
                             alt="{{ $relacionado->nombre }}"
                             style="height:180px; object-fit:contain; margin-bottom:10px;">

                        <h3 style="font-size:17px; font-weight:700;">{{ $relacionado->nombre }}</h3>
                        <p style="font-size:16px; font-weight:700; color:burlywood; margin-bottom:10px;">
                            {{ $relacionado->precio }} €
                        </p>

                        <a href="/producto/{{ $relacionado->slug }}"
                           style="
                            padding:8px 14px;
                            background:burlywood;
                            color:white;
                            border-radius:8px;
                            font-weight:600;
                            font-size:14px;
                            text-decoration:none;
                       ">
                            Ver producto
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

    </section>

@endsection
