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

Route::get('/user/signup', [UserController::class, 'Signup'])->name('signup');
Route::get('/user/signin', [UserController::class, 'Signin'])->name('signin');

Route::post('/user/login', [UserController::class, 'login'])->name('user.login');
Route::post('/user/register', [UserController::class, 'register'])->name('user.register');
Route::post('/user/logout', [UserController::class, 'logout'])->name('user.logout');

Route::post('/upload/resume', [FileUploadController::class, 'uploadResume'])->name('upload.resume');
