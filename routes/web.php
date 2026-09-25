<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Homepage redirects to the task list
Route::get('/', function () {
    return redirect()->route('tasks.index');
});

// Creates all 7 CRUD routes automatically
Route::resource('tasks', TaskController::class);

// Extra route for updating status
Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])
    ->name('tasks.updateStatus');