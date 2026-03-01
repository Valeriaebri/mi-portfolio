<header class="header">
    <div class="header__container">

        <nav class="nav">

            {{-- MENÚ PÚBLICO (SIEMPRE VISIBLE) --}}
            <a href="/">INICIO</a>

            {{-- PRODUCTOS CON DROPDOWN (SOLO CLIENTE E INVITADO) --}}
            @php
                $categoriasMenu = \App\Models\Categoria::where('activo', 1)->get();
            @endphp

            <div class="cuenta-dropdown">

                <a href="/productos" class="cuenta-btn">
                    PRODUCTOS
                </a>

                <div class="cuenta-menu">
                    @foreach($categoriasMenu as $cat)
                        <a href="/categoria_user/{{ $cat->slug }}">
                            {{ $cat->nombre }}
                        </a>
                    @endforeach
                </div>

            </div>

            <a href="/quienessomos">QUIÉNES SOMOS</a>
            <a href="/opiniones">OPINIONES</a>

            {{-- CARRITO (SIEMPRE VISIBLE) --}}
            <a href="/carrito" class="carrito-link">
                <svg xmlns="http://www.w3.org/2000/svg"
                     width="16" height="16" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round"
                     style="margin-right:6px;">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
            </a>


            {{-- SI EL USUARIO ESTÁ LOGUEADO --}}
            @auth

                {{-- CLIENTE --}}
                @if(auth()->user()->role === 'cliente')
                    <a href="/pedidos">MIS PEDIDOS</a>

                    <form action="/logout" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" class="logout-btn">Salir</button>
                    </form>
                @endif

                {{-- ADMIN (MENÚ UNIFICADO) --}}
                @if(auth()->user()->role === 'admin')

                    <div class="cuenta-dropdown">
                        <button class="cuenta-btn">
                            ADMIN
                        </button>

                        <div class="cuenta-menu">
                            <a href="/admin">Dashboard</a>
                            <a href="/admin/productos">Productos</a>
                            <a href="/admin/categorias">Categorías</a>


                            <form action="/logout" method="POST" style="margin:0;">
                                @csrf
                                <button type="submit" class="logout-btn" style="width:100%; text-align:left; padding:10px 14px;">
                                    Salir
                                </button>
                            </form>
                        </div>
                    </div>

                @endif

            @else

                {{-- INVITADO (NO LOGUEADO) --}}
                <div class="cuenta-dropdown">
                    <button class="cuenta-btn">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             width="18" height="18" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round"
                             style="margin-right:6px;">
                            <circle cx="12" cy="7" r="4"></circle>
                            <path d="M5.5 21a6.5 6.5 0 0 1 13 0"></path>
                        </svg>
                    </button>

                    <div class="cuenta-menu">
                        <a href="/login">INICIAR SESIÓN</a>
                        <a href="/register">REGISTRARSE</a>
                    </div>
                </div>

            @endauth

        </nav>

    </div>
</header>
