<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ArticleController::class, 'index']);
Route::get('/category', [ArticleController::class, 'category']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->group(function () {
    Route::get('/journalist', [ArticleController::class, 'create']);
    Route::post('/journalist', [ArticleController::class, 'store']);
});

Route::get('/admin', function () {
    return view('admin');
})->middleware('auth');