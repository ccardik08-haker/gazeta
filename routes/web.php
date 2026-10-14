<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TextController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// Публичные разделы
Route::get('/', [TextController::class, 'index'])->name('home');
Route::get('/category', [TextController::class, 'category'])->name('category');

// Авторизация
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Журналист: только Журналист и Администратор
Route::middleware(['auth', 'role:Журналист,Администратор'])->group(function () {
    Route::get('/journalist', [TextController::class, 'create'])->name('journalist');
    Route::post('/journalist', [TextController::class, 'store']);
});

// Админ: только Администратор
Route::middleware(['auth', 'role:Администратор'])->group(function () {
    Route::get('/admin', function () {
        $users = User::with('role')->get();
        $roles = Role::all();
        return view('admin', compact('users', 'roles'));
    })->name('admin');
});