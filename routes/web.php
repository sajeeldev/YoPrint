<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\FileUploadController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('/upload/resume', [FileUploadController::class, 'uploadResume'])->name('upload.resume');

Route::prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/signup', [UserController::class, 'signUp'])->name('signUp');
        Route::get('/signin', [UserController::class, 'signIn'])->name('signIn');
    });

Route::prefix('auth')
    ->name('auth.')
    ->group(function () {
        Route::post('register', [UserController::class, 'register'])->name('register');
        Route::post('/login', [UserController::class, 'login'])->name('login');
        Route::post('/logout', [UserController::class, 'logout'])
        ->middleware('auth')
        ->name('logout');
});