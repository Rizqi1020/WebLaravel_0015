<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Langsung panggil index blade tanpa controller berita
Route::get('/', function () {
    return view('index', ['posts' => \App\Models\Post::all()]); 
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);