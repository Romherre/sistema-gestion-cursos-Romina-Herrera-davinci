@extends('layouts.app')

@section('titulo', 'Editar Curso')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Editar Curso</h2>

    <form action="{{ route('cursos.update', $curso) }}" method="POST">
        @csrf
        @method('PUT')
        @include('cursos.form', ['curso' => $curso])
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('cursos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
