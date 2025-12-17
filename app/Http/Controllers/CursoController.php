<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Docente;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::with('docente')->get();
        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        $docentes = Docente::where('activo', true)->get();
        return view('cursos.create', compact('docentes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo'        => 'required|string|max:255',
            'descripcion'   => 'required|string',
            'fecha_inicio'  => 'required|date',
            'fecha_fin'     => 'required|date|after:fecha_inicio',
            'estado'        => 'required|in:activo,finalizado,cancelado',
            'modalidad'     => 'required|in:presencial,virtual,hibrido',
            'aula_virtual'  => 'nullable|required_if:modalidad,virtual,hibrido|string|max:255',
            'cupos_maximos' => 'required|integer|min:1',
            'docente_id'    => 'required|exists:docentes,id',
        ]);

        // Validar que el docente esté activo
        $docente = Docente::find($data['docente_id']);
        if (!$docente || !$docente->activo) {
            return back()->withErrors(['docente_id' => 'No se puede asignar un curso a un docente inactivo.'])->withInput();
        }

        // Validar que el docente no tenga más de 3 cursos activos
        $cursosActivos = Curso::where('docente_id', $docente->id)
            ->where('estado', 'activo')
            ->count();
        if ($data['estado'] === 'activo' && $cursosActivos >= 3) {
            return back()->withErrors(['estado' => 'El docente ya tiene 3 cursos activos.'])->withInput();
        }

        Curso::create($data);
        return redirect()->route('cursos.index')->with('success', 'Curso creado correctamente.');
    }

    public function show(Curso $curso)
    {
        //
    }

    public function edit(Curso $curso)
    {
        $docentes = Docente::where('activo', true)->get();
        return view('cursos.edit', compact('curso', 'docentes'));
    }

    public function update(Request $request, Curso $curso)
    {
        $data = $request->validate([
            'titulo'        => 'required|string|max:255',
            'descripcion'   => 'required|string',
            'fecha_inicio'  => 'required|date',
            'fecha_fin'     => 'required|date|after:fecha_inicio',
            'estado'        => 'required|in:activo,finalizado,cancelado',
            'modalidad'     => 'required|in:presencial,virtual,hibrido',
            'aula_virtual'  => 'nullable|required_if:modalidad,virtual,hibrido|string|max:255',
            'cupos_maximos' => 'required|integer|min:1',
            'docente_id'    => 'required|exists:docentes,id',
        ]);

        // Validar que el docente esté activo
        $docente = Docente::find($data['docente_id']);
        if (!$docente || !$docente->activo) {
            return back()->withErrors(['docente_id' => 'No se puede asignar un curso a un docente inactivo.'])->withInput();
        }

        // Validar que el docente no tenga más de 3 cursos activos (excluyendo el actual curso)
        $cursosActivos = Curso::where('docente_id', $docente->id)
            ->where('estado', 'activo')
            ->where('id', '!=', $curso->id)
            ->count();
        if ($data['estado'] === 'activo' && $cursosActivos >= 3) {
            return back()->withErrors(['estado' => 'El docente ya tiene 3 cursos activos.'])->withInput();
        }

        $curso->update($data);
        return redirect()->route('cursos.index')->with('success', 'Curso actualizado correctamente.');
    }

    public function destroy(Curso $curso)
    {
        $curso->delete();
        return back()->with('success', 'Curso eliminado.');
    }
}
