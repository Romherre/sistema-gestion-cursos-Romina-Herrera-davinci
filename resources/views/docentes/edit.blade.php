{{-- resources/views/docentes/edit.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Editar Docente')
@section('contenido')
<form action="{{ route('docentes.update', $docente) }}" method="POST">
    @csrf
    @method('PUT')
    @include('docentes.form')
    <button class="btn btn-primary">Actualizar</button>
</form>
@endsection
