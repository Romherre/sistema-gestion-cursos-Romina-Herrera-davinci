@extends('layouts.app')

{{-- Usamos la sección 'titulo' definida en app.blade.php --}}
@section('titulo', 'Dashboard del Coordinador')

{{-- Usamos la sección 'contenido' definida en app.blade.php --}}
@section('contenido')
<div class="row">
    <div class="col-12">
        <h1>Panel de Coordinación</h1>
        <p class="lead">Bienvenido al área de gestión de inscripciones y evaluaciones.</p>
    </div>
</div>

<hr>

<div class="row mt-4">
    {{-- Tarjeta de Inscripciones --}}
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Gestión de Inscripciones</h5>
                <p class="card-text">Registra, lista y elimina inscripciones de alumnos a cursos.</p>
                <a href="{{ route('coord.inscripciones.index') }}" class="btn btn-primary">
                    Ir a Inscripciones
                </a>
            </div>
        </div>
    </div>

{{-- Tarjeta de Evaluaciones (en coordinador/dashboard.blade.php) --}}
<div class="col-md-6 mb-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Gestión de Evaluaciones</h5>
            <p class="card-text">Administra notas y asistencias de los alumnos.</p>
            <a href="{{ route('coord.evaluaciones.index') }}" class="btn btn-primary">
                Ir a Evaluaciones
            </a>
        </div>
    </div>
</div>
@endsection
