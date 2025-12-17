@extends('layouts.app')

@section('contenido')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h1 class="h3 mb-0">Subir Material para Curso</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('archivos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="curso_id" class="form-label">Curso Vinculado</label>
                    <select name="curso_id" id="curso_id" class="form-select @error('curso_id') is-invalid @enderror" required>
                        <option value="">Seleccione un curso...</option>
                        @foreach($cursos as $c)
                            <option value="{{ $c->id }}" {{ old('curso_id') == $c->id ? 'selected' : '' }}>
                                {{ $c->titulo }}
                            </option>
                        @endforeach
                    </select>
                    @error('curso_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="titulo" class="form-label">Título del Documento</label>
                    <input type="text" name="titulo" id="titulo" class="form-control @error('titulo') is-invalid @enderror"
                           value="{{ old('titulo') }}" placeholder="Ej: Guía de Ejercicios N°1" required>
                    @error('titulo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo de Material</label>
                    <select name="tipo" id="tipo" class="form-select @error('tipo') is-invalid @enderror" required>
                        <option value="material" {{ old('tipo') == 'material' ? 'selected' : '' }}>Material</option>
                        <option value="tarea" {{ old('tipo') == 'tarea' ? 'selected' : '' }}>Tarea</option>
                        <option value="guía" {{ old('tipo') == 'guía' ? 'selected' : '' }}>Guía</option>
                    </select>
                    @error('tipo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="archivo" class="form-label">Seleccionar Archivo (PDF, DOCX, PPT, JPG, PNG)</label>
                    <input type="file" name="archivo" id="archivo" class="form-control @error('archivo') is-invalid @enderror" required>
                    <div class="form-text">Tamaño máximo: 2MB. Formatos permitidos por consigna.</div>
                    @error('archivo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('archivos.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-success">Subir y Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
