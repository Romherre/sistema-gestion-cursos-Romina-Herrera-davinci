<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\Inscripcion;
use App\Models\Docente;
use Illuminate\Http\Request;

class EvaluacionController extends Controller
{
    public function index()
    {
        $evaluaciones = Evaluacion::with(['inscripcion.alumno', 'inscripcion.curso', 'docente'])
            ->orderBy('fecha', 'desc')
            ->get();

        return view('evaluaciones.index', compact('evaluaciones'));
    }

    public function create()
    {
        $inscripciones = Inscripcion::with(['alumno', 'curso'])->get();
        $docentes = Docente::where('activo', true)->get();

        return view('evaluaciones.create', compact('inscripciones', 'docentes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'inscripcion_id' => 'required|exists:inscripciones,id',
            'docente_id'     => 'required|exists:docentes,id',
            'tipo'           => 'required|string',
            'nota'           => 'required|numeric|min:1|max:10',
            'fecha'          => 'required|date|before_or_equal:today',
            'descripcion'    => 'nullable|string|max:500',
        ]);

        $inscripcion = Inscripcion::findOrFail($request->inscripcion_id);

        Evaluacion::create([
            'alumno_id'   => $inscripcion->alumno_id,
            'curso_id'    => $inscripcion->curso_id,
            'docente_id'  => $request->docente_id,
            'descripcion' => $request->descripcion,
            'nota'        => $request->nota,
            'fecha'       => $request->fecha,
            'tipo'        => $request->tipo,
        ]);

        return redirect()->route('coord.evaluaciones.index')
            ->with('success', 'Evaluación registrada correctamente.');
    }

    public function edit($id)
    {
        $evaluacion = Evaluacion::findOrFail($id);
        $inscripciones = Inscripcion::with(['alumno', 'curso'])->get();
        $docentes = Docente::where('activo', true)->get();

        return view('evaluaciones.edit', compact('evaluacion', 'inscripciones', 'docentes'));
    }

    public function update(Request $request, $id)
    {
        // 1. Buscamos el registro real por su ID
        $evaluacion = Evaluacion::findOrFail($id);

        // 2. Validamos los datos que vienen del formulario
        $request->validate([
            'inscripcion_id' => 'required|exists:inscripciones,id',
            'docente_id'     => 'required|exists:docentes,id',
            'nota'           => 'required|numeric|min:1|max:10',
            'fecha'          => 'required|date',
            'tipo'           => 'nullable|string',
            'descripcion'    => 'nullable|string',
        ]);

        // 3. Obtenemos la inscripción para actualizar alumno_id y curso_id
        $inscripcion = \App\Models\Inscripcion::findOrFail($request->inscripcion_id);

        // 4. Guardamos los cambios usando tus nombres de columna (fecha, alumno_id, curso_id)
        $evaluacion->update([
            'alumno_id'   => $inscripcion->alumno_id,
            'curso_id'    => $inscripcion->curso_id,
            'docente_id'  => $request->docente_id,
            'tipo'        => $request->tipo,
            'nota'        => $request->nota,
            'fecha'       => $request->fecha,
            'descripcion' => $request->descripcion,
        ]);

        // 5. Volvemos al listado con mensaje de éxito
        return redirect()->route('coord.evaluaciones.index')
            ->with('success', 'Evaluación actualizada correctamente.');
    }
    public function destroy($id)
    {
        $evaluacion = Evaluacion::findOrFail($id);
        $evaluacion->delete();

        return redirect()->route('coord.evaluaciones.index')->with('success', 'Evaluación eliminada permanentemente.');
    }
}
