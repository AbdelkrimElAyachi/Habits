<?php

use App\Http\Controllers\HabitController;
use App\Http\Controllers\HabitTaskController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// 1. GUEST ROUTE: This is what people see if they are NOT logged in
Route::get('/', function (Request $request) {
    if (auth()->check()) {
        return app(HabitController::class)->index($request);
    }
    return view('welcome');
})->name('habits.index');

// 2. LEGAL ROUTES: Privacy Policy and Terms of Service
Route::view('/privacy', 'legal.privacy')->name('privacy');
Route::view('/terms', 'legal.terms')->name('terms');

Route::middleware('auth')->group(function () {
    // habit
    Route::resource('/habits', HabitController::class)->except('index');
    // task
    Route::post('/habits/{habit}/tasks', [HabitTaskController::class, 'store'])->name('tasks.store');
    Route::patch('/habits/{habit}/tasks/{task}', [HabitTaskController::class, 'update'])->name('tasks.update');
    Route::delete('/habits/{habit}/tasks/{task}', [HabitTaskController::class, 'destroy'])->name('tasks.destroy');
    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
