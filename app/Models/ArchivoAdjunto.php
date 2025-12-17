<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivoAdjunto extends Model
{
    use HasFactory;

    protected $table = 'archivos_adjuntos';

    protected $fillable = [
        'curso_id',
        'titulo',
        'archivo_url',
        'tipo',
        'fecha_subida'
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }
}
