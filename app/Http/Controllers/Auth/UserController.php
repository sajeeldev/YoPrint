<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class UserController extends Controller
{
    Public function Signup()
    {
        return view('Auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        User::create($validated);

        return redirect()->route('user.login')->with('success', 'Registration successful. Please log in.');
    }

    public function Signin()
    {
        return view('Auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect()->route('login');
    }
}
