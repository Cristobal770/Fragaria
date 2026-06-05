<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{

    public function showLogin(Request $request)
    {

        $usuarios = User::all();

        $usuarioSeleccionado = null;
        if ($request->has('user_id')) {
            $usuarioSeleccionado = User::find($request->user_id);
        }

        return view('auth.login', compact('usuarios', 'usuarioSeleccionado'));
    }


    public function login(Request $request)
    {

        $request->validate([
            'nickname' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('nickname', $request->nickname)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->route('fra.inicio');
        }

        return back()->withErrors([
            'nickname' => 'El nickname o la contraseña son incorrectos.',
        ]);

    }











    public function showRegister()
    {
        return view('auth.register');
    }


    public function register(Request $request)
    {

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'nickname'   => 'required|string|max:50|unique:users,nickname',
            'password'   => 'required|min:4',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'nickname'   => $request->nickname,
            'password'   => Hash::make($request->password),
        ]);


        Auth::login($user);
        return redirect()->route('fra.inicio');
    }







    

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
