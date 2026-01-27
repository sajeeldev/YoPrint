<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\FileUpload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Carbon\Carbon;

class UserController extends Controller
{

    public function dashboard()
    {
        $this->files = FileUpload::where('user_id', user()->id)->get();
        // dd($this->files);
        $this->user = User::where('id', user()->id)->first();
        // dd($user->name);
        foreach( $this->files as $file ) {
            // $this->data['files'][] = $file;
            $this->timeAgo = Carbon::parse($file->created_at)->diffForHumans();
        }
        // dd($timeAgo, $dateTime);

        return view('dashboard', $this->data);
    }


    Public function signUp()
    {
        return view('Auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        try {
            $validated['password'] = bcrypt($validated['password']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Registration failed. Please try again.'])->withInput();
        }
        User::create($validated);

        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    public function loginPage()
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
        return redirect()->route('home');
    }
}
