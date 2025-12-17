<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\ArchivoAdjuntoController;
use Illuminate\Support\Facades\Auth;

// --- RUTAS PÚBLICAS ---
Route::get('/', function () {
    if (Auth::check()) {
        // Redirección lógica según rol si ya está logueado
        if (Auth::user()->rol === 'admin') return redirect()->route('admin.dashboard');
        if (Auth::user()->rol === 'coordinador') return redirect()->route('coord.dashboard');
    }
    return view('layouts.index');
})->name('home');

Route::get('login', [AuthController::class, 'mostrarLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'showForm'])->name('register.form');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');

// --- RUTAS ADMINISTRADOR ---
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', fn() => view('admin.dashboard'))->name('admin.dashboard');
    Route::resource('alumnos',   AlumnoController::class);
    Route::resource('docentes',  DocenteController::class);
    Route::resource('cursos',    CursoController::class);
    Route::resource('archivos',  ArchivoAdjuntoController::class);
});

// --- RUTAS COORDINADOR ---

Route::middleware(['auth', 'coordinador'])
    ->name('coord.')
    ->prefix('coord')
    ->group(function () {

    // URL: /coord -> Nombre: coord.dashboard
    Route::get('/', fn() => view('coordinador.dashboard'))->name('dashboard');

    // Inscripciones
    Route::resource('inscripciones', InscripcionController::class)
        ->only(['index', 'create', 'store', 'destroy']);


    Route::resource('evaluaciones', EvaluacionController::class);
});
