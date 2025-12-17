@extends('layouts.app')

@section('titulo', 'Gestión de Evaluaciones')

@section('contenido')
    <div class="container">
        <h1>Evaluaciones Registradas</h1>
        <hr>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('coord.evaluaciones.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Registrar Evaluación
            </a>
            <a href="{{ route('coord.dashboard') }}" class="btn btn-outline-secondary">
                Volver al Dashboard
            </a>
        </div>

        @if ($evaluaciones->isEmpty())
            <div class="alert alert-info">No hay evaluaciones registradas.</div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Alumno</th>
                            <th>Curso</th>
                            <th>Tipo</th>
                            <th>Nota</th>
                            <th>Fecha</th>
                            <th>Docente</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($evaluaciones as $evaluacion)
                            <tr>
                                <td>{{ $evaluacion->id }}</td>

                                {{-- Usamos Null-Safe para Inscripción -> Alumno --}}
                                <td>{{ $evaluacion->inscripcion?->alumno?->nombre }} {{ $evaluacion->inscripcion?->alumno?->apellido }}</td>

                                {{-- Usamos Null-Safe para Inscripción -> Curso --}}
                                <td>{{ $evaluacion->inscripcion?->curso?->titulo }}</td>

                                <td>{{ $evaluacion->tipo }}</td>
                                <td>{{ number_format($evaluacion->nota, 1) }}</td>
                                <td>{{ $evaluacion->fecha?->format('d/m/Y') }}</td>

                                {{-- Usamos Null-Safe para Docente --}}
                                <td>{{ $evaluacion->docente?->nombre }} {{ $evaluacion->docente?->apellido }}</td>

                                <td>
                                    <a href="{{ route('coord.evaluaciones.edit', $evaluacion) }}" class="btn btn-sm btn-warning">Editar</a>

                                    <form action="{{ route('coord.evaluaciones.destroy', $evaluacion) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Confirma eliminar esta evaluación?')">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
