<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'email',
        'fecha_nacimiento',
        'telefono',
        'direccion',
        'genero',
        'activo'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'activo'           => 'boolean',
    ];
    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }
    public function cursosActivos()
    {
        return $this->inscripciones()->where('estado', 'activo');
    }


    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class);
    }
}
