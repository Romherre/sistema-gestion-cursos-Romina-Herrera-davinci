@extends('layouts.app')

@section('titulo','Listado de Docentes')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Listado de Docentes</h2>
    <a href="{{ route('docentes.create') }}" class="btn btn-primary mb-3">Agregar Docente</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Email</th>
                <th>Especialidad</th>
                <th>Teléfono</th>       {{-- <- Agregado --}}
                <th>Dirección</th>      {{-- <- Agregado --}}
                <th>Activo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($docentes as $d)
            <tr>
                <td>{{ $d->nombre }}</td>
                <td>{{ $d->apellido }}</td>
                <td>{{ $d->dni }}</td>
                <td>{{ $d->email }}</td>
                <td>{{ $d->especialidad }}</td>
                <td>{{ $d->telefono }}</td>    {{-- <- Agregado --}}
                <td>{{ $d->direccion }}</td>   {{-- <- Agregado --}}
                <td>
                    @if($d->activo)
                        <span class="badge bg-success">Sí</span>
                    @else
                        <span class="badge bg-secondary">No</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('docentes.edit',$d) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('docentes.destroy',$d) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('¿Seguro?')" class="btn btn-sm btn-danger">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">No hay docentes.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

