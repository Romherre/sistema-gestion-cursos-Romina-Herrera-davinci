@extends('layouts.app')

@section('titulo', 'Registrar Nueva Evaluación')

@section('contenido')
    <div class="container">
        <h1>Registrar Evaluación</h1>
        <hr>

        {{-- Formulario POST que apunta al método store --}}
        <form action="{{ route('coord.evaluaciones.store') }}" method="POST">
            @csrf

            <div class="row">

                {{-- Campo Inscripción (Alumno + Curso) --}}
                <div class="col-md-6 mb-3">
                    <label for="inscripcion_id" class="form-label">Inscripción a Evaluar:</label>
                    <select name="inscripcion_id" id="inscripcion_id" class="form-select @error('inscripcion_id') is-invalid @enderror" required>
                        <option value="">-- Seleccione Alumno/Curso --</option>
                        {{-- Iteramos sobre las inscripciones que cargamos en el controller --}}
                        @foreach ($inscripciones as $inscripcion)
                            {{-- Mostramos el alumno y el curso para una mejor UX --}}
                            <option value="{{ $inscripcion->id }}" {{ old('inscripcion_id') == $inscripcion->id ? 'selected' : '' }}>
                                {{ $inscripcion->alumno?->nombre }} {{ $inscripcion->alumno?->apellido }} ({{ $inscripcion->curso?->titulo }})
                            </option>
                        @endforeach
                    </select>
                    @error('inscripcion_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Campo Docente --}}
                <div class="col-md-6 mb-3">
                    <label for="docente_id" class="form-label">Docente Evaluador:</label>
                    <select name="docente_id" id="docente_id" class="form-select @error('docente_id') is-invalid @enderror" required>
                        <option value="">-- Seleccione un Docente --</option>
                        @foreach ($docentes as $docente)
                            <option value="{{ $docente->id }}" {{ old('docente_id') == $docente->id ? 'selected' : '' }}>
                                {{ $docente->nombre }} {{ $docente->apellido }}
                            </option>
                        @endforeach
                    </select>
                    @error('docente_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div> {{-- Fin Row 1 --}}

            <div class="row">
                {{-- Campo Tipo de Evaluación --}}
                <div class="col-md-4 mb-3">
                    <label for="tipo" class="form-label">Tipo de Evaluación:</label>
                    <select name="tipo" id="tipo" class="form-select @error('tipo') is-invalid @enderror" required>
                        <option value="">-- Seleccione Tipo --</option>
                        @php
                            $tipos = ['Parcial', 'Final', 'Recuperatorio', 'Trabajo Práctico'];
                        @endphp
                        @foreach ($tipos as $t)
                            <option value="{{ $t }}" {{ old('tipo') == $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                    @error('tipo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Campo Nota --}}
                <div class="col-md-4 mb-3">
                    <label for="nota" class="form-label">Nota (1 a 10):</label>
                    <input type="number" step="0.1" min="1" max="10" name="nota" id="nota" class="form-control @error('nota') is-invalid @enderror" value="{{ old('nota') }}" required>
                    @error('nota')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Campo Fecha de Evaluación --}}
                <div class="col-md-4 mb-3">
                    <label for="fecha" class="form-label">Fecha de Evaluación:</label>
                    <input type="date" name="fecha" id="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha', now()->toDateString()) }}" required>
                    @error('fecha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div> {{-- Fin Row 2 --}}

            {{-- Campo Descripción/Observaciones --}}
            <div class="mb-4">
                <label for="descripcion" class="form-label">Descripción/Observaciones:</label>
                <textarea name="descripcion" id="descripcion" rows="3" class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-start gap-2 mt-4">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Registrar Evaluación
                </button>
                <a href="{{ route('coord.evaluaciones.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection
