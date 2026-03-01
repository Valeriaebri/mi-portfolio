@extends('layouts.master')

@section('content')

    <div class="grid-container">

        <h1 class="titulo-seccion">
            {{ $categoria->nombre }}
        </h1>

        @if($productos->isEmpty())
            <p>No hay productos en esta categoría.</p>
        @else

            <div class="shop-grid">

                @foreach ($productos as $producto)
                    <div class="shop-card">

                        <div class="shop-card-content">

                            <div class="shop-info">
                                <h3>{{ $producto->nombre }}</h3>

                                <p class="descripcion-corta">
                                    {{ Str::limit(strip_tags($producto->descripcion), 120) }}
                                </p>

                                <p class="precio">{{ number_format($producto->precio, 2, ',', '.') }} €</p>

                                <a href="/producto/{{ $producto->slug }}" class="btn-ver">Ver producto</a>
                            </div>

                            <div class="shop-img">
                                <img src="/img/productos/{{ $producto->imagen }}" alt="{{ $producto->nombre }}">
                            </div>

                        </div>

                    </div>
                @endforeach

            </div>

            <div class="paginacion">
                {{ $productos->links() }}
            </div>

        @endif

    </div>

@endsection
