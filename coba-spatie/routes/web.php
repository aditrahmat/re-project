<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;


// Resources //
Route::resource('projects', ProjectController::class);
Route::resource('tasks', TaskController::class);
// resources //


Route::get('/', function () {
    return view('welcome');
});
// Administrator -- Administrator --Administrator -- Administrator -- Administrator -- Administrator -- Administrator -- Administrator -- Administrator -- Administrator --Administrator//

Route::middleware(['auth', 'role:Administrator|Staff'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'admin'])->name('dashboard');
    // Kontrol user 
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

// Administrator -- Administrator --Administrator -- Administrator -- Administrator -- Administrator -- Administrator -- Administrator -- Administrator -- Administrator --Administrator//
// Route::middleware(['auth', 'role:Staff'])->group(function () {
//     Route::get('dashboard', [DashboardController::class, 'user'])->name('dashboard');
//     Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
//     Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');

Route::put('/tasks/{task}/update-status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
Route::put('/tasks/{task}', [ProjectController::class, 'update'])->name('tasks.update');

require __DIR__ . '/auth.php';
