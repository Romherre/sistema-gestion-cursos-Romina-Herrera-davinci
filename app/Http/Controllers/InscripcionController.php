<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Alumno;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InscripcionController extends Controller
{
    /**
     * Muestra una lista de todas las inscripciones.
     */
    public function index()
    {
        // Cargamos las relaciones 'alumno' y 'curso' para evitar la N+1 Query Problem
        $inscripciones = Inscripcion::with(['alumno', 'curso'])->get();

        // Retorna la vista con la lista de inscripciones
        return view('inscripciones.index', compact('inscripciones'));
    }

    /**
     * Muestra el formulario para crear una nueva inscripción.
     */
    public function create()
    {
        // Obtenemos solo alumnos activos y cursos en estado 'activo'
        $alumnos = Alumno::where('activo', true)->get();
        $cursos  = Curso::where('estado', 'activo')->get();

        // Retorna la vista con los datos necesarios para el formulario
        return view('inscripciones.create', compact('alumnos', 'cursos'));
    }

    /**
     * Almacena una nueva inscripción en la base de datos.
     */
    public function store(Request $request)
    {
        // 1. Validaciones
        $validatedData = $request->validate([
            'alumno_id' => [
                'required',
                'exists:alumnos,id',

                Rule::unique('inscripciones')->where(function ($query) use ($request) {
                    return $query->where('curso_id', $request->curso_id);
                }),
            ],
            'curso_id'  => 'required|exists:cursos,id',
        ]);

        // 2. Control de Cupos
        $curso = Curso::findOrFail($validatedData['curso_id']);
        $inscritos = $curso->inscripciones()->count();

        if ($inscritos >= $curso->cupos_maximos) {
            return back()
                ->withInput()
                ->withErrors(['curso_id' => 'El curso ' . $curso->titulo . ' ha alcanzado su límite máximo de cupos.']);
        }


        // 3. Preparar datos y Crear
        $validatedData['fecha_inscripcion'] = now();


        Inscripcion::create($validatedData);

        // 4. Redireccionar
        return redirect()
            ->route('coord.inscripciones.index')
            ->with('success', 'Inscripción creada correctamente.');
    }

    /**
     * Elimina una inscripción específica.
     */
    public function destroy(Inscripcion $inscripcion)
    {

        $inscripcion->delete();

        return back()->with('success', 'Inscripción eliminada correctamente.');
    }
}
