@extends('layouts.app')

@section('titulo', 'Crear Curso')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Crear Curso</h2>

    <form action="{{ route('cursos.store') }}" method="POST">
        @csrf
        @include('cursos.form', ['curso' => null])
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('cursos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
