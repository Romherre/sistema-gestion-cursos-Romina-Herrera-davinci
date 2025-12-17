@extends('layouts.app')

@section('titulo', 'Listado de Cursos')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Listado de Cursos</h2>

    <a href="{{ route('cursos.create') }}" class="btn btn-primary mb-3">Crear Curso</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>Modalidad</th>
                <th>Estado</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Docente</th>
                <th>Cupos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cursos as $curso)
            <tr>
                <td>{{ $curso->titulo }}</td>
                <td>{{ ucfirst($curso->modalidad) }}</td>
                <td>{{ ucfirst($curso->estado) }}</td>
                <td>{{ $curso->fecha_inicio }}</td>
                <td>{{ $curso->fecha_fin }}</td>
                <td>{{ $curso->docente->nombre }} {{ $curso->docente->apellido }}</td>
                <td>{{ $curso->cupos_maximos }}</td>
                <td>
                    <a href="{{ route('cursos.edit', $curso) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('cursos.destroy', $curso) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('¿Estás seguro?')" class="btn btn-sm btn-danger">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No hay cursos registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
