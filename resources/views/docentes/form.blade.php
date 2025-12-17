<div class="mb-3">
    <label class="form-label">Nombre</label>
    <input name="nombre" class="form-control"
        value="{{ old('nombre', $docente->nombre ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Apellido</label>
    <input name="apellido" class="form-control"
        value="{{ old('apellido', $docente->apellido ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">DNI</label>
    <input name="dni" class="form-control"
        value="{{ old('dni', $docente->dni ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control"
        value="{{ old('email', $docente->email ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Especialidad</label>
    <input name="especialidad" class="form-control"
        value="{{ old('especialidad', $docente->especialidad ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Teléfono</label>
    <input name="telefono" class="form-control"
        value="{{ old('telefono', $docente->telefono ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Dirección</label>
    <input name="direccion" class="form-control"
        value="{{ old('direccion', $docente->direccion ?? '') }}">
</div>

<div class="form-check mb-3">
    <input type="checkbox" name="activo" value="1" class="form-check-input"
        {{ old('activo', $docente->activo ?? true) ? 'checked':'' }}>
    <label class="form-check-label">Activo</label>
</div>
