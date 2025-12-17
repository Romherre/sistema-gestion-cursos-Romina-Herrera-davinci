<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::all();
        return view('docentes.index', compact('docentes'));
    }

    public function create()
    {
        return view('docentes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'       => 'required|string|max:100',
            'apellido'     => 'required|string|max:100',
            'dni'          => 'required|numeric|unique:docentes,dni',
            'email'        => 'required|email|unique:docentes,email',
            'especialidad' => 'required|string|max:100',
            'telefono'     => 'required|string|max:20',
            'direccion'    => 'required|string|max:255',
            'activo'       => 'sometimes|boolean',
        ]);

    // 2) Añadimos manualmente el booleano
        $data['activo'] = $request->has('activo');

        // 3) Creamos el docente
        Docente::create($data);

        return redirect()->route('docentes.index')
                        ->with('success', 'Docente creado correctamente.');
    }

    public function edit(Docente $docente)
    {
        return view('docentes.edit', compact('docente'));
    }

    public function update(Request $request, Docente $docente)
    {
        $data = $request->validate([
            'nombre'       => 'required|string|max:100',
            'apellido'     => 'required|string|max:100',
            'dni'          => "required|numeric|unique:docentes,dni,{$docente->id}",
            'email'        => "required|email|unique:docentes,email,{$docente->id}",
            'especialidad' => 'required|string|max:100',
            'telefono'     => 'required|string|max:20',
            'direccion'    => 'required|string|max:255',
            'activo'       => 'sometimes|boolean',
        ]);

        $data['activo'] = $request->has('activo');

        $docente->update($data);

        return redirect()->route('docentes.index')
                        ->with('success', 'Docente actualizado correctamente.');
    }

    public function destroy(Docente $docente)
    {
        $docente->delete();
        return back()->with('success', 'Docente eliminado.');
    }
}
