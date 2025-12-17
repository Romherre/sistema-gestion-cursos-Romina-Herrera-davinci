<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;


    protected $table = 'evaluaciones';

    protected $fillable = [
    'alumno_id',
    'curso_id',
    'descripcion',
    'nota',
    'fecha',
    ];

    protected $casts = [
        'fecha' => 'date',
        'nota' => 'decimal:1',
    ];


    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class);
    }


    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }
}
