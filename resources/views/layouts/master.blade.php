<!DOCTYPE html>
<html lang="es">
<head>

    <link rel="icon" type="image/png" href="/img/logos/logo-favicon.png">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reset Free Beauty</title>

    <!-- Tipografía -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- CSS global -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- CSS específico de cada página -->
    @yield('css')
</head>

<body>

@include('includes.header')

<main>
    @yield('content')
</main>

@include('includes.footer')

<!-- Scripts globales -->
<script src="{{ asset('js/app.js') }}"></script>

<!-- Scripts específicos de cada página -->
@yield('scripts')

</body>
</html>
