<div class="mb-3">
    <label class="form-label">Título</label>
    <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $curso->titulo ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Descripción</label>
    <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion', $curso->descripcion ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Fecha de Inicio</label>
    <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio', $curso->fecha_inicio ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Fecha de Fin</label>
    <input type="date" name="fecha_fin" class="form-control" value="{{ old('fecha_fin', $curso->fecha_fin ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Modalidad</label>
    <select name="modalidad" class="form-select">
        <option value="">Seleccionar</option>
        @foreach(['presencial', 'virtual', 'hibrido'] as $modalidad)
            <option value="{{ $modalidad }}"
                {{ old('modalidad', $curso->modalidad ?? '') == $modalidad ? 'selected' : '' }}>
                {{ ucfirst($modalidad) }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Aula Virtual (si corresponde)</label>
    <input type="text" name="aula_virtual" class="form-control" value="{{ old('aula_virtual', $curso->aula_virtual ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Cupos Máximos</label>
    <input type="number" name="cupos_maximos" class="form-control" value="{{ old('cupos_maximos', $curso->cupos_maximos ?? 30) }}">
</div>

<div class="mb-3">
    <label class="form-label">Estado</label>
    <select name="estado" class="form-select">
        @foreach(['activo', 'finalizado', 'cancelado'] as $estado)
            <option value="{{ $estado }}"
                {{ old('estado', $curso->estado ?? '') == $estado ? 'selected' : '' }}>
                {{ ucfirst($estado) }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Docente Asignado</label>
    <select name="docente_id" class="form-select">
        <option value="">Seleccionar Docente</option>
        @foreach($docentes as $docente)
            <option value="{{ $docente->id }}"
                {{ old('docente_id', $curso->docente_id ?? '') == $docente->id ? 'selected' : '' }}>
                {{ $docente->nombre }} {{ $docente->apellido }}
            </option>
        @endforeach
    </select>
</div>
