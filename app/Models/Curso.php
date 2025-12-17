<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo','descripcion',
        'fecha_inicio','fecha_fin',
        'estado','modalidad',
        'aula_virtual','cupos_maximos',
        'docente_id'
    ];
    public function docente()
{
    return $this->belongsTo(Docente::class);
}

public function inscripciones()
{
    return $this->hasMany(Inscripcion::class);
}

public function evaluaciones()
{
    return $this->hasMany(Evaluacion::class);
}

public function archivos()
{
    return $this->hasMany(ArchivoAdjunto::class);
}

}
