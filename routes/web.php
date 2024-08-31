<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;

//Redirect the root URL to the login page if the user is not authenticated
Route::get('/', function () {
    return redirect()->route('login');
})->middleware('guest');

// Registration routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Login routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


// Task management routes (protected by authentication middleware)
Route::middleware('auth:sanctum')->group(function () {
    //Logout route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    Route::get('/tasks', [TodoController::class, 'index'])->name('todo.index');
    Route::get('/maketask', [TodoController::class, 'create'])->name('todo.create');
    Route::post('/store', [TodoController::class, 'store'])->name('todo.store');
    Route::get('/edit/{id}', [TodoController::class, 'edit'])->name('todo.edit');
    Route::post('/update/{id}', [TodoController::class, 'update'])->name('todo.update');
    Route::delete('/delete/{id}', [TodoController::class, 'destroy'])->name('todo.destroy');
});

