<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;



class RegisterController extends Controller
{
public $photo;

public function updateProfileInformation()
{
    dd($request->file('photo')); // Mostrará información sobre el archivo cargado

    $this->validate([
        'photo' => 'image|max:1024', // 1MB Max
    ]);

    if ($this->photo) {
        $path = $this->photo->store('profile-photos', 'public');
        $this->user->update([
            'profile_photo_path' => $path
        ]);
    }

    $this->emit('saved');
}

                

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Manejar el registro del usuario
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'photo' => 'nullable|image|max:2048', // Validación para la foto, 2 MB máximo
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        // Manejar la carga de la foto, si existe
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profile-photos', 'public');
            $user->update([
                'profile_photo_path' => $path
            ]);
        }

        auth()->login($user); // Iniciar sesión al usuario automáticamente
    
        return redirect()->route('home'); // Redirigir al 'home' en lugar de 'dashboard'
    }

    public function render()
    {
        return view('profile.update-profile-information');
    }
}
