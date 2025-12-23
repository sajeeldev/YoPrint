<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\FileUploadController;

Route::get('/', function () {
    return view('welcome');
})->middleware('guest')->name('home');

Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');

Route::post('/upload/resume', [FileUploadController::class, 'uploadFile'])->name('upload.csvfile');


Route::get('/signup', [UserController::class, 'signUp'])->name('signUp');
Route::get('/signin', [UserController::class, 'signIn'])->name('signIn');

Route::prefix('auth')
    ->name('auth.')
    ->group(function () {
        Route::post('register', [UserController::class, 'register'])->name('register');
        Route::post('/login', [UserController::class, 'login'])->name('login');
        Route::post('/logout', [UserController::class, 'logout'])
        ->middleware('auth')
        ->name('logout');
});