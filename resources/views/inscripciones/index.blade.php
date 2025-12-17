@extends('layouts.app')

{{-- Usa la sección 'titulo' definida en tu layout principal --}}
@section('titulo', 'Listado de Inscripciones')

@section('contenido')
    <div class="container">
        <h1>Inscripciones Registradas</h1>
        <hr>

        {{-- Mensaje de éxito/error (Bootstrap Alert) --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">Hubo un error al procesar la solicitud.</div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('coord.inscripciones.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Registrar Nueva Inscripción
            </a>
            <a href="{{ route('coord.dashboard') }}" class="btn btn-outline-secondary">
                Volver al Dashboard
            </a>
        </div>

        @if ($inscripciones->isEmpty())
            <div class="alert alert-info">No hay inscripciones registradas.</div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Alumno</th>
                            <th>Curso</th>
                            <th>Fecha</th>
                            <th>Nota Final</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inscripciones as $inscripcion)
                            <tr>
                                <td>{{ $inscripcion->id }}</td>

                                {{-- USO DEL OPERADOR NULL-SAFE (?->) --}}
                                {{-- Esto evita el error "Undefined property" si el alumno_id es inválido/null --}}
                                <td>
                                    {{ $inscripcion->alumno?->nombre }} {{ $inscripcion->alumno?->apellido }}
                                    @empty($inscripcion->alumno)
                                        <span class="badge bg-danger">Inválido</span>
                                    @endempty
                                </td>

                                {{-- USO DEL OPERADOR NULL-SAFE (?->) --}}
                                {{-- Esto evita el error "Undefined property" si el curso_id es inválido/null --}}
                                <td>
                                    {{ $inscripcion->curso?->titulo }}
                                    @empty($inscripcion->curso)
                                        <span class="badge bg-danger">Inválido</span>
                                    @endempty
                                </td>

                                {{-- Usamos 'fecha_inscripcion' que es un objeto Carbon gracias a los $casts --}}
                                <td>{{ $inscripcion->fecha_inscripcion ? $inscripcion->fecha_inscripcion->format('d/m/Y') : 'N/A' }}</td>

                                {{-- Usamos el campo 'nota_final' que definiste en tu modelo. Usa ?? para manejar NULLs --}}
                                <td>{{ $inscripcion->nota_final ?? 'Sin calificar' }}</td>

                                <td>
                                    {{-- Botón de Eliminar (Usando el método DELETE) --}}
                                    <form action="{{ route('coord.inscripciones.destroy', $inscripcion) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Confirma eliminar la inscripción?')">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
