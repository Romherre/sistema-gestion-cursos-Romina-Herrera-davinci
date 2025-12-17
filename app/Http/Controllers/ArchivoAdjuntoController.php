<?php

namespace App\Http\Controllers;

use App\Models\ArchivoAdjunto;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchivoAdjuntoController extends Controller
{
   public function index()
{
    $archivos = ArchivoAdjunto::with('curso')->get();
    return view('archivos.index', compact('archivos'));
}

public function create()
{
    $cursos = Curso::all();
    return view('archivos.create', compact('cursos'));
}
    public function store(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'titulo'   => 'required|string|max:255',
            'tipo'     => 'required|in:tarea,material,guía',
            'archivo'  => 'required|file|mimes:pdf,docx,ppt,jpg,png|max:2048' // Validaciones de la consigna [cite: 119]
        ]);

        if ($request->hasFile('archivo')) {
            // Guardar el archivo físicamente
            $ruta = $request->file('archivo')->store('materiales', 'public');

            ArchivoAdjunto::create([
                'curso_id'     => $request->curso_id,
                'titulo'       => $request->titulo,
                'archivo_url'  => $ruta,
                'tipo'         => $request->tipo,
                'fecha_subida' => now()->format('Y-m-d')
            ]);
        }

        return redirect()->route('archivos.index')->with('success', 'Archivo subido correctamente.');
    }

    public function destroy($id)
    {
        $archivo = ArchivoAdjunto::findOrFail($id);


        if (Storage::disk('public')->exists($archivo->archivo_url)) {
            Storage::disk('public')->delete($archivo->archivo_url);
        }

        $archivo->delete();
        return redirect()->route('archivos.index')->with('success', 'Archivo eliminado.');
    }
}
