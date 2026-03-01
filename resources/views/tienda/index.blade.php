@extends('layouts.master')

@section('content')

    {{-- HERO PRINCIPAL --}}
    <section class="hero-home">
        <div class="hero-content">
            <img src="/img/logos/logo-reset-negativo.png" alt="Reset Free Beauty" class="hero-logo">

            <div class="hero-products">
                <img src="/img/home/prod-amarillo.png" class="prod prod1">
                <img src="/img/home/prod-verde.png" class="prod prod2">
                <img src="/img/home/prod-azul.png" class="prod prod3">
                <img src="/img/home/prod-rosa.png" class="prod prod4">
                <img src="/img/home/prod-naranja.png" class="prod prod5">
            </div>
        </div>
    </section>

    {{-- GRID DE PRODUCTOS --}}
    <section class="productos-grid">
        <div class="grid-container">
            <h2 class="titulo-seccion">Nuestros productos</h2>

            <div class="grid">

                @php
                    function texturaProducto($nombre) {
                        $nombre = trim(strtolower($nombre));

                        return match ($nombre) {
                            'dua lime'        => 1,
                            'kiwi minogue'    => 2,
                            'cactus perry'    => 3,
                            'piña turner',
                            'pina turner'     => 4,
                            'mango cyrus'     => 5,
                            'elton lemon'     => 6,
                            'grape kelly'     => 7,
                            'mad orange',
                            'madorange'       => 8,
                            default           => 1,
                        };
                    }
                @endphp



            @foreach ($productos->reverse() as $producto)
                    <div class="card-producto textura-{{ texturaProducto($producto->nombre) }}">
                        <img src="/img/productos/{{ $producto->imagen }}" alt="{{ $producto->nombre }}">
                        <h3>{{ $producto->nombre }}</h3>
                        <p class="precio">{{ $producto->precio }} €</p>
                        <a href="/producto/{{ $producto->slug }}" class="btn-ver">Ver más</a>
                    </div>
                @endforeach


            </div>
        </div>
    </section>

@endsection
