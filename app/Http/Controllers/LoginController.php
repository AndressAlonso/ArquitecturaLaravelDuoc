<?php

namespace App\Http\Controllers;

use App\Models\ServicioClinico;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\RopaController;
class LoginController extends Controller
{
    public function registro()
    {


        $sClinicos = DB::table('servicio_clinico')->get();
        return view('registro', compact('sClinicos'));
    }
    public function register(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('home')->with('success', 'Ya estás logueado!');
        } else {
            $request->validate([
                'fname' => 'required|string|max:255|min:3',
                'lname' => 'required|string|max:255|min:3',
                'sClinicos' => 'required|array',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ], [
                'fname.required' => 'El nombre es obligatorio.',
                'sClinicos.required' => 'El usuario debe tener servicios clinicos asociados.',
                'fname.min' => 'El nombre debe tener al menos 3 caracteres.',
                'fname.max' => 'El nombre no debe tener más de 255 caracteres.',
                'lname.required' => 'El apellido es obligatorio.',
                'lname.min' => 'El apellido debe tener al menos 3 caracteres.',
                'lname.max' => 'El apellido no debe tener más de 255 caracteres.',
                'email.required' => 'El correo electrónico es obligatorio.',
                'email.unique' => 'El correo electrónico ya está en uso.',
                'password.required' => 'La contraseña es obligatoria.',
                'password.confirmed' => 'Las contraseñas no coinciden.',
                'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            ]);


            $user = new User();
            $user->email = strtolower($request->email);
            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->sClinicos = json_encode($request->sClinicos);
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect(route('login'))->with('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
        }
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => strtolower($request->email),
            'password' => $request->password
        ];
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended('/')->with('success', '¡Bienvenido, ' . Auth::user()->fname . '!');
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
