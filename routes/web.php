<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
Route::put('/todos/{id}', [TodoController::class, 'update'])->name('todos.update');
Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');
Route::patch('/todos/{id}/toggle', [TodoController::class, 'toggleComplete'])->name('todos.toggle');

Route::get('/', [TodoController::class, 'showWelcome'])->name('welcome');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/about', function () {
    return view('about');
});


