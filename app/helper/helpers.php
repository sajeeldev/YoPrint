<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


if (!function_exists('user')) {

    /**
     * Return current logged-in user
     */
    function user()
    {
        if (session()->has('user')) {
            return session('user');
        }

        $authId = Auth::id();

        if ($authId) {
            $user = User::find($authId);

            if ($user) {
                session(['user' => $user]);
                return $user;
            }

            Auth::logout();
        }

        return null;
    }

}

if (!function_exists('path')) {
    
    /*
    * Return path to a given resource
    *
    */
    function path($resource) {
        return base_path($resource);
    }

}