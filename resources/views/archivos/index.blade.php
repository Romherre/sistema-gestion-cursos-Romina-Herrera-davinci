@extends('layouts.app')

@section('contenido')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Materiales y Adjuntos</h1>
        <a href="{{ route('archivos.create') }}" class="btn btn-primary">Subir Nuevo Archivo</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Curso</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($archivos as $archivo)
                <tr>
                    <td>{{ $archivo->titulo }}</td>
                    <td>{{ $archivo->curso?->titulo }}</td>
                    <td>
                        <form action="{{ route('archivos.destroy', $archivo->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
