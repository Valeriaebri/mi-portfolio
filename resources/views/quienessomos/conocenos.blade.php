@extends('layouts.master')

@section('content')

    <div class="container" style="max-width: 1100px; margin-top: 60px;">

        <h1 class="titulo-seccion" style="text-align:center;">
            Únete al movimiento Reset
        </h1>

        <p style="text-align:center; font-size:18px; max-width:700px; margin:0 auto 40px;">
            Reivindicamos una cosmética sencilla, eficaz y pensada para todos.
            Rutinas rápidas, resultados reales y productos creados con ciencia y cariño.
        </p>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:50px; align-items:center; margin-bottom:60px;">

            <div>
                <h2 style="font-size:26px; font-weight:700; margin-bottom:20px;">
                    ¿Cómo surgió Reset?
                </h2>

                <p style="font-size:16px; line-height:1.6; margin-bottom:20px;">
                    Reset nace de la mano de <strong>Alba Moneo</strong>, farmacéutica apasionada de la cosmética que decidió
                    revolucionar el cuidado personal con productos eficaces, rápidos y sin complicaciones.
                </p>

                <p style="font-size:16px; line-height:1.6; margin-bottom:20px;">
                    Inspirada en su entorno, creó fórmulas basadas en ciencia y rutinas que ahorran tiempo,
                    enamorando tanto a hombres como a mujeres por su simplicidad y resultados inmediatos.
                </p>

                <p style="font-size:16px; line-height:1.6;">
                    Nuestra misión es que cualquier persona pueda cuidarse de forma eficaz, entendiendo su piel
                    y utilizando productos formulados con mimo, rigor y cariño a partes iguales.
                </p>
            </div>

            <div style="text-align:center;">
                <img src="/img/productos/quienessomos.png"
                     alt="Imagen Reset"
                     style="width:100%; max-width:420px; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.1);">
            </div>

        </div>

        <div style="text-align:center; margin-top:40px;">
            <a href="https://instagram.com" target="_blank"
               style="display:inline-flex; align-items:center; gap:10px; text-decoration:none; color:#333; font-weight:600; font-size:18px;">

                <svg xmlns="http://www.w3.org/2000/svg"
                     width="26" height="26" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                </svg>

                Síguenos en Instagram
            </a>
        </div>

    </div>

@endsection
