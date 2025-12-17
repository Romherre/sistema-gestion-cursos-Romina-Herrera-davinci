<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// Es bueno importar la clase User si se va a usar directamente
use App\Models\User;

class AuthController extends Controller
{
    public function mostrarLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 1. Buscar el usuario por email
        $user = User::where('email', $request->email)->first();
        // Usamos la clase User importada arriba. (Esto reemplaza \App\Models\User::where...)

        // 2. Verificar si el usuario existe y si el password es correcto (Hash::check)
        if ($user && Hash::check($request->password, $user->password)) {

            Auth::login($user); // Iniciar sesión con el usuario encontrado
            $request->session()->regenerate();

            // 3. LÓGICA DE REDIRECCIÓN CONDICIONAL POR ROL (¡EL CAMBIO CLAVE!)

            if ($user->rol === 'admin') {
                // Redirige al dashboard del administrador
                return redirect()->route('admin.dashboard');
            }

            if ($user->rol === 'coordinador') {
                // Redirige al dashboard del coordinador.
                // Usamos 'coord.dashboard' que es el nombre correcto según la ruta de grupo.
                return redirect()->route('coord.dashboard');
            }

            // Si es cualquier otro rol (ej. docente, alumno)
            return redirect('/');

            // COMENTARIO: Tu código original tenía una doble verificación aquí que causaba problemas.
            // Se ha eliminado la segunda verificación IF para simplificar el flujo.

        } // Fin del IF principal (si la autenticación falló)

        // Si la verificación Hash::check() falla o el usuario no existe.
        return back()->withErrors([
            'email' => 'Credenciales inválidas.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
