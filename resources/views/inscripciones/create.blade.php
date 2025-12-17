@extends('layouts.app')

@section('titulo', 'Registrar Nueva Inscripción')

@section('contenido')
    <div class="container">
        <h1>Registrar Nueva Inscripción</h1>
        <hr>

        {{-- Formulario que apunta al método store del InscripcionController --}}
        <form action="{{ route('coord.inscripciones.store') }}" method="POST">
            @csrf

            <div class="row">

                {{-- Campo Alumno --}}
                <div class="col-md-6 mb-3">
                    <label for="alumno_id" class="form-label">Alumno Activo:</label>
                    <select name="alumno_id" id="alumno_id" class="form-select @error('alumno_id') is-invalid @enderror" required>
                        <option value="">-- Seleccione un Alumno --</option>
                        @foreach ($alumnos as $alumno)
                            <option value="{{ $alumno->id }}" {{ old('alumno_id') == $alumno->id ? 'selected' : '' }}>
                                {{ $alumno->nombre }} {{ $alumno->apellido }} (DNI: {{ $alumno->dni }})
                            </option>
                        @endforeach
                    </select>
                    @error('alumno_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Campo Curso --}}
                <div class="col-md-6 mb-3">
                    <label for="curso_id" class="form-label">Curso Activo:</label>
                    <select name="curso_id" id="curso_id" class="form-select @error('curso_id') is-invalid @enderror" required>
                        <option value="">-- Seleccione un Curso --</option>
                        @foreach ($cursos as $curso)
                            {{-- Aquí puedes mostrar información adicional, como cupos --}}
                            <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
                                {{ $curso->titulo }} (Cupos: {{ $curso->cupos_maximos }})
                            </option>
                        @endforeach
                    </select>
                    @error('curso_id')
                        {{-- El error de cupos o duplicado aparecerá aquí --}}
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div> {{-- Fin Row --}}

            <div class="d-flex justify-content-start gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Inscribir Alumno
                </button>
                <a href="{{ route('coord.inscripciones.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection
