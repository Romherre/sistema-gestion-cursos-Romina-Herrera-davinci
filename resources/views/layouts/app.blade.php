<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('titulo') - Sistema de Gestión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

@auth
<nav class="navbar navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Inicio</a>

    <div class="ms-auto d-flex align-items-center gap-3">
        <span class="text-white">
            Bienvenido/a, {{ auth()->user()->name }}
        </span>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-outline-light btn-sm">Cerrar sesión</button>
        </form>
    </div>
</nav>
@endauth

<div class="container mt-4">
    @yield('contenido')
</div>

</body>
</html>
