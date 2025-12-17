@extends('layouts.app')

@section('contenido')
    <div class="container">
        <h1>Editar Evaluación #{{ $evaluacion->id }}</h1>
        <hr>

           <form action="{{ route('coord.evaluaciones.update', ['evaluacione' => $evaluacion->id]) }}" method="POST">
            @csrf
            @method('PUT') {{-- ¡Importante! Laravel necesita PUT para actualizar --}}

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Inscripción:</label>
                    <select name="inscripcion_id" class="form-select" required>
                        @foreach ($inscripciones as $i)
                            <option value="{{ $i->id }}" {{ $evaluacion->inscripcion_id == $i->id ? 'selected' : '' }}>
                                {{ $i->alumno?->nombre }} - {{ $i->curso?->titulo }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Docente:</label>
                    <select name="docente_id" class="form-select" required>
                        @foreach ($docentes as $d)
                            <option value="{{ $d->id }}" {{ $evaluacion->docente_id == $d->id ? 'selected' : '' }}>
                                {{ $d->nombre }} {{ $d->apellido }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Nota:</label>
                    <input type="number" step="0.1" name="nota" class="form-control" value="{{ old('nota', $evaluacion->nota) }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Fecha:</label>
                    <input type="date" name="fecha" class="form-control" value="{{ $evaluacion->fecha?->format('Y-m-d') }}" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="{{ route('coord.evaluaciones.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
