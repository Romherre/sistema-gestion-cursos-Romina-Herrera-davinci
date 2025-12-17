<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function index()
    {
        $alumnos = Alumno::all();
        return view('alumnos.index', compact('alumnos'));
    }

    public function create()
    {
        return view('alumnos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'          => 'required|string|max:100',
            'apellido'        => 'required|string|max:100',
            'dni'             => 'required|numeric|unique:alumnos',
            'email'           => 'required|email|unique:alumnos',
            'fecha_nacimiento' => 'required|date|before:-16 years',
            'telefono'        => 'required|string|max:20',
            'direccion'       => 'required|string|max:255',
            'genero'          => 'required|in:masculino,femenino,otro',
            'activo'         => 'sometimes|boolean',
        ]);

        Alumno::create($data);
        return redirect()->route('alumnos.index')
            ->with('success', 'Alumno creado correctamente.');
    }

    public function edit(Alumno $alumno)
    {
        return view('alumnos.edit', compact('alumno'));
    }

    public function update(Request $request, Alumno $alumno)
    {
        $data = $request->validate([
            'nombre'          => 'required|string|max:100',
            'apellido'        => 'required|string|max:100',
            'dni'             => "required|numeric|unique:alumnos,dni,{$alumno->id}",
            'email'           => "required|email|unique:alumnos,email,{$alumno->id}",
            'fecha_nacimiento' => 'required|date|before:-16 years',
            'telefono'        => 'required|string|max:20',
            'direccion'       => 'required|string|max:255',
            'genero'          => 'required|in:masculino,femenino,otro',
            'activo'         => 'sometimes|boolean',
        ]);

        $data['activo'] = $request->has('activo');

    $alumno->update($data);
        $alumno->update($data);
        return redirect()->route('alumnos.index')
            ->with('success', 'Alumno actualizado correctamente.');
    }

    public function destroy(Alumno $alumno)
    {
        $alumno->delete();
        return redirect()->route('alumnos.index')
            ->with('success', 'Alumno eliminado correctamente.');
    }
}
