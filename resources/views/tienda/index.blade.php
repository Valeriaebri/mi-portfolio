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
                    // Creamos un array de texturas del 1 al 8
                    $texturas = range(1, 8);

                    // Mezclamos el array para que NO se repitan
                    shuffle($texturas);
                @endphp

                @foreach ($productos->reverse() as $index => $producto)
                    <div class="card-producto textura-{{ $texturas[$index] }}">
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
