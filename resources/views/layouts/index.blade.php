@extends('layouts.guest')

@section('titulo','Inicio')

@section('contenido')
<div class="text-center">
    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" width="120">
    <h2 class="mt-4">Bienvenida al Sistema de Gestión de Cursos</h2>
    <p>¿Tenés una cuenta o querés registrarte?</p>

    <div class="d-flex justify-content-center gap-3">
        <a href="{{ route('login') }}" class="btn btn-outline-primary">Iniciar sesión</a>
        <a href="{{ route('register.form') }}" class="btn btn-outline-secondary">Registrarse</a>
    </div>
</div>
@endsection
