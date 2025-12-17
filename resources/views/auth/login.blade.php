@extends('layouts.guest')

@section('titulo', 'Iniciar sesión')

@section('contenido')
<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow p-4" style="min-width: 350px;">
        <h3 class="text-center mb-4">Iniciar sesión</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>¡Error!</strong> {{ $errors->first('email') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </div>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('register.form') }}">¿No tenés cuenta? Registrate</a>
        </div>
    </div>
</div>
@endsection
