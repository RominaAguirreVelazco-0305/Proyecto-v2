<?php 

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // Extender la clase base del controlador

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Asegúrate de tener esta vista en resources/views/auth/login.blade.php
    }

    public function login(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar la autenticación
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            // Si las credenciales son correctas, redirige al dashboard
            return redirect()->intended('dashboard');
        }

        // Si fallan las credenciales, redirige de vuelta con un error
        return back()->withErrors([
            'email' => 'Credenciales incorrectas, por favor inténtalo de nuevo.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // Utiliza el guard "web" explícitamente para asegurar que se llama al método correcto
        auth('web')->logout();
    
        // Invalida la sesión
        $request->session()->invalidate();
    
        // Regenera el token CSRF
        $request->session()->regenerateToken();
    
        // Redirige a la página de inicio
        return redirect('/home');
    }
    
    
}
