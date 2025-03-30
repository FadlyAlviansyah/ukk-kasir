<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            
            if ($user) {
                return redirect()->route('dashboard')->with('loginSuccess', 'Login Successfully');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login')->with('logout', 'Logout Success');
    }
}
