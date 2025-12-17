@extends('layouts.app')

@section('titulo', 'Listado de Alumnos')

@section('contenido')
<div class="container mt-4">
    {{-- 1. Feedback --}}
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <h2 class="mb-4">Listado de Alumnos</h2>
    <a href="{{ route('alumnos.create') }}" class="btn btn-primary mb-3">Agregar Alumno</a>

    {{-- 2. Tabla mejorada --}}
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Género</th> {{-- Nueva columna --}}
                <th>Activo</th> {{-- Nueva columna --}}
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($alumnos as $alumno)
            <tr>
                <td>{{ $alumno->nombre }}</td>
                <td>{{ $alumno->apellido }}</td>
                <td>{{ $alumno->dni }}</td>
                <td>{{ $alumno->email }}</td>
                <td>{{ $alumno->telefono }}</td>
                <td>{{ ucfirst($alumno->genero) }}</td>
                <td>
                    @if($alumno->activo)
                    <span class="badge bg-success">Sí</span>
                    @else
                    <span class="badge bg-secondary">No</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('alumnos.edit', $alumno) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('alumnos.destroy', $alumno) }}"
                        method="POST"
                        class="d-inline"
                        onsubmit="return confirm('¿Estás seguro de eliminar este alumno?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No hay alumnos registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
