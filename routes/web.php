<?php

use App\Http\Controllers\HabitController;
use App\Http\Controllers\HabitTaskController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/mail-preview', function () {
    $notification = new \Illuminate\Auth\Notifications\ResetPassword('test-token');
    $user = \App\Models\User::first() ?? new \App\Models\User(['email' => 'test@example.com']);
    
    return $notification->toMail($user);
});

// 1. GUEST ROUTE: This is what people see if they are NOT logged in
Route::get('/', function (Request $request) {
    if (auth()->check()) {
        return app(HabitController::class)->index($request);
    }
    return view('welcome');
})->name('habits.index');

Route::middleware('auth')->group(function () {
    // habit
    Route::resource('/habits', HabitController::class)->except('index');

    // task
    Route::post('/habits/{habit}/tasks', [HabitTaskController::class, 'store'])
                                                                                ->name('tasks.store');
    Route::patch('/habits/{habit}/tasks/{task}', [HabitTaskController::class, 'update'])
                                                                                    ->name('tasks.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
