@extends('layouts.app')

@section('titulo', 'Crear Alumno')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Registrar Nuevo Alumno</h2>

    {{-- Mostrar errores de validación --}}
    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('alumnos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre"
                class="form-control" value="{{ old('nombre') }}" required>
        </div>

        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" name="apellido" id="apellido"
                class="form-control" value="{{ old('apellido') }}" required>
        </div>

        <div class="mb-3">
            <label for="dni" class="form-label">DNI</label>
            <input type="text" name="dni" id="dni"
                class="form-control" value="{{ old('dni') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email"
                class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                class="form-control" value="{{ old('fecha_nacimiento') }}" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono"
                class="form-control" value="{{ old('telefono') }}" required>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" id="direccion"
                class="form-control" value="{{ old('direccion') }}" required>
        </div>

        <div class="mb-3">
            <label for="genero" class="form-label">Género</label>
            <select name="genero" id="genero" class="form-select" required>
                <option value="">Selecciona…</option>
                <option value="masculino" {{ old('genero')=='masculino'?'selected':'' }}>Masculino</option>
                <option value="femenino" {{ old('genero')=='femenino'?'selected':'' }}>Femenino</option>
                <option value="otro" {{ old('genero')=='otro'?'selected':'' }}>Otro</option>
            </select>
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="activo" id="activo"
                value="1" {{ old('activo') ? 'checked' : '' }}>
            <label class="form-check-label" for="activo">
                Alumno activo
            </label>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('alumnos.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
</div>
@endsection
