@extends('layouts.master')

@section('content')

    <section class="productos-grid">
        <div class="grid-container">
            <h2 class="titulo-seccion">Tienda</h2>

            <div class="shop-grid">

                @foreach ($productos as $producto)
                    <div class="shop-card shop-{{ strtolower($producto->color) }}">

                        <div class="shop-card-content">

                            {{-- TEXTO A LA IZQUIERDA --}}
                            <div class="shop-info">
                                <h3>{{ $producto->nombre }}</h3>

                                <p class="descripcion-corta">
                                    {{ Str::limit(strip_tags($producto->descripcion), 120) }}
                                </p>

                                <p class="precio">{{ number_format($producto->precio, 2, ',', '.') }} €</p>

                                <a href="/producto/{{ $producto->slug }}" class="btn-ver">Ver producto</a>
                            </div>

                            {{-- IMAGEN A LA DERECHA --}}
                            <div class="shop-img">
                                <img src="/img/productos/{{ $producto->imagen }}" alt="{{ $producto->nombre }}">
                            </div>

                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </section>

@endsection
