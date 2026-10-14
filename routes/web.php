<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TextController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// Публичные разделы
Route::get('/', [TextController::class, 'index'])->name('home');
Route::get('/text/{id}', [TextController::class, 'show'])->name('text.show');
Route::get('/category', [TextController::class, 'categoriesList'])->name('categories');
Route::get('/category/{id}', [TextController::class, 'category'])->name('category');

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
    Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin');

    Route::post('/admin/texts/{id}/delete', [\App\Http\Controllers\AdminController::class, 'destroyText']);
    Route::post('/admin/texts/{id}/block', [\App\Http\Controllers\AdminController::class, 'toggleBlock']);
    Route::get('/admin/texts/{id}/edit', [\App\Http\Controllers\AdminController::class, 'editText']);
    Route::post('/admin/texts/{id}/update', [\App\Http\Controllers\AdminController::class, 'updateText']);

    Route::post('/admin/users/{id}/role', [\App\Http\Controllers\AdminController::class, 'changeRole']);
});