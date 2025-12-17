@extends('layouts.app')

@section('titulo', 'Registro de Usuario')

@section('contenido')
<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow p-4" style="min-width: 400px;">
        <h3 class="text-center mb-4">Registro de Usuario</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="name" required autofocus>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <select class="form-select" name="rol" required>
                    <option value="">Seleccionar rol</option>
                    <option value="admin">Administrador</option>
                    <option value="coordinador">Coordinador</option>
                </select>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">Registrarme</button>
            </div>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}">¿Ya tenés cuenta? Iniciar sesión</a>
        </div>
    </div>
</div>
@endsection
