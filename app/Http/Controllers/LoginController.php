<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('home')->with('success', 'Ya estás logueado!');
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ], [
                'name.required' => 'El nombre es obligatorio.',
                'email.required' => 'El correo electrónico es obligatorio.',
                'email.unique' => 'Este correo electrónico ya está en uso.',
                'password.required' => 'La contraseña es obligatoria.',
                'password.confirmed' => 'Las contraseñas no coinciden.',
            ]);
            
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            
            return redirect(route('login'))->with('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
        }
    }

    public function login(Request $request)
    {
        // Validación
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $remember = ($request->has('remember') ? true : false);

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', '¡Bienvenido, ' . Auth::user()->name . '!');
        } else {
            return redirect(route('login'))->with('error', 'Credenciales incorrectas. Por favor, inténtalo de nuevo.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'))->with('success', 'Has Cerrado Sesión. ¡Hasta luego!');
    }
}
