@extends('layouts.app')
@section('titulo','Alta de Docente')
@section('contenido')
<div class="container mt-4">
    <h2>Registrar Docente</h2>
    <form action="{{ route('docentes.store') }}" method="POST">
        @csrf
        @include('docentes.form')
        <button class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
