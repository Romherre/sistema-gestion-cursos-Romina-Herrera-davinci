@extends('layouts.app')

@section('titulo', 'Panel de Administración')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Panel del Administrador</h2>

    <div class="row g-4">
        <!-- Alumnos -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-success shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Alumnos</h5>
                    <p class="card-text">Registrar, editar y eliminar alumnos.</p>
                    <a href="{{ route('alumnos.index') }}" class="btn btn-success">Gestionar</a>
                </div>
            </div>
        </div>

        <!-- Docentes -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Docentes</h5>
                    <p class="card-text">Alta, baja y modificación de docentes.</p>
                    <a href="{{ route('docentes.index') }}" class="btn btn-primary">Gestionar</a>
                </div>
            </div>
        </div>

        <!-- Cursos -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-warning shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Cursos</h5>
                    <p class="card-text">Crear, editar y asignar docentes.</p>
                    <a href="{{ route('cursos.index') }}" class="btn btn-warning text-white">Gestionar</a>
                </div>
            </div>
        </div>

        <!-- Archivos Adjuntos -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-dark shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Archivos</h5>
                    <p class="card-text">Subir o eliminar materiales de los cursos.</p>
                    <a href="{{ route('archivos.index') }}" class="btn btn-dark">Gestionar</a>
                </div>
            </div>
        </div>

        <!-- Usuarios (opcional) -->
        {{-- <div class="col-md-6 col-lg-4">
            <div class="card border-info shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-text">Registrar o modificar cuentas de usuario.</p>
                    <a href="#" class="btn btn-info text-white">Gestionar</a>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection
