@extends('layouts.master')

@section('content')

    <div class="container" style="max-width:1100px; margin-top:50px;">

        {{-- CABECERA --}}
        <div style="text-align:center; margin-bottom:40px;">
            <h1 style="font-size:34px; font-weight:700; margin-bottom:10px;">
                Opiniones de nuestros clientes
            </h1>

            <div style="font-size:22px; font-weight:600; margin-bottom:6px;">
                4.9 / 5 ⭐
            </div>

            <p style="font-size:15px; color:#555;">
                Basado en más de 1.200 opiniones verificadas
            </p>
        </div>

        {{-- BARRAS + IMAGEN ALINEADAS --}}
        <div style="
            display:flex;
            justify-content:center;
            align-items:center;
            gap:80px;
            margin-bottom:60px;
            flex-wrap:wrap;
        ">

            {{-- BARRA DE ESTRELLAS --}}
            <div style="width:500px;">

                @foreach([5,4,3,2,1] as $stars)
                    <div style="display:flex; align-items:center; margin-bottom:12px;">
                        <span style="width:90px; font-size:15px;">{{ $stars }} estrellas</span>

                        <div style="flex:1; height:12px; background:#eee; border-radius:6px; margin:0 12px; overflow:hidden;">
                            <div style="width:{{ [5=>90,4=>8,3=>1,2=>0.5,1=>0.5][$stars] }}%; height:100%; background:burlywood;"></div>
                        </div>

                        <span style="font-size:15px;">{{ [5=>1080,4=>96,3=>12,2=>6,1=>6][$stars] }}</span>
                    </div>
                @endforeach

            </div>

            {{-- IMAGEN A LA DERECHA --}}
            <div style="display:flex; align-items:center;">
                <a href="/img/productos/todos.png">
                    <img src="/img/productos/todos.png"
                         alt="Productos Reset"
                         style="
                            width:100%;
                            max-width:420px;
                            border-radius:14px;
                            box-shadow:0 4px 12px rgba(0,0,0,0.1);
                            object-fit:contain;
                         ">
                </a>
            </div>

        </div>

        {{-- LISTADO DE OPINIONES --}}
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:30px;">

            @php
                $colores = ['#ff6fa8','#6fbaff','#7ed957','#ffe066','#ff9f40','#c77dff'];
                $i = 0;
            @endphp

            @foreach([
                ['Ana', 'Me encanta cómo deja la piel, textura ligera y olor increíble.', 5],
                ['Laura', 'Resultados visibles desde la primera semana. Repetiré seguro.', 5],
                ['Carlos', 'Muy fácil de aplicar y se absorbe rápido. Perfecto para diario.', 4],
                ['Marta', 'Me ha sorprendido muchísimo, calidad-precio brutal.', 5],
                ['Javier', 'Lo uso cada mañana y me deja la piel súper suave.', 5],
                ['Sofía', 'Me gusta, aunque esperaba un olor más intenso.', 4],
            ] as $op)

                @php
                    $color = $colores[$i % count($colores)];
                    $i++;
                @endphp

                <div style="
                    background:white;
                    padding:20px;
                    border-radius:12px;
                    box-shadow:0 4px 12px rgba(0,0,0,0.08);
                ">
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:12px;">
                        <div style="
                            width:45px;
                            height:45px;
                            background:{{ $color }};
                            border-radius:50%;
                        "></div>

                        <div>
                            <strong style="font-size:15px;">{{ $op[0] }}</strong>
                            <div style="font-size:13px; color:#777;">
                                {{ now()->subDays(rand(1,30))->format('d/m/Y') }}
                            </div>
                        </div>
                    </div>

                    <div style="color:burlywood; margin-bottom:10px;">
                        @for($s=0; $s < $op[2]; $s++)
                            ⭐
                        @endfor
                    </div>

                    <p style="font-size:14px; line-height:1.5;">
                        {{ $op[1] }}
                    </p>
                </div>

            @endforeach

        </div>

        {{-- BOTÓN CARGAR MÁS --}}
        <div style="text-align:center; margin-top:40px;">
            <a href="#" style="
                padding:10px 20px;
                background:burlywood;
                color:white;
                border-radius:8px;
                font-weight:600;
                text-decoration:none;
            ">
                Cargar más opiniones
            </a>
        </div>

    </div>

@endsection
