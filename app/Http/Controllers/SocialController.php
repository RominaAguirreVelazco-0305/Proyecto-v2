<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log; // Asegúrate de importar la clase Log

class SocialController extends Controller
{
    /**
     * Redirige al usuario al proveedor de OAuth.
     */
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtiene la información del usuario desde el proveedor de OAuth y lo maneja.
     */
    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            // Busca un usuario existente o crea uno nuevo con los datos de Socialite
            $user = User::updateOrCreate(
                ['email' => $socialUser->getEmail()], // Busca el usuario por email
                [
                    'name' => $socialUser->getName(), // Usa el nombre de Socialite
                    'password' => bcrypt('random-password') // Genera una contraseña aleatoria
                ]
            );

            // Iniciar sesión al usuario
            Auth::login($user, true); // El segundo parámetro 'true' es para "remember" el usuario

            return redirect('/dashboard'); // Redirige al usuario a una ruta deseada tras el inicio de sesión exitoso
        } catch (\Exception $e) {
            Log::error("Error de autenticación social con $provider: " . $e->getMessage());
            return redirect('/login')->withErrors('Error al iniciar sesión con ' . $provider . ': ' . $e->getMessage());
        }
    }
}
