<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function indexLogin()
    {
        return view('pages.login.index');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            "email" => "required|email|max:255",
            "password" => "required",
        ], [
            "email.required" => "Email Field Required",
            'email.email' => 'Email Field must be a valid email address',
            "password.required" => "Password Field Required",
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Login Successfully as Super Admin');
        } else {
            return redirect('/login')->with('error', 'Login Failed, Check your Email and Password!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
