<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriesController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

// Matches The "/categories/users" URL
Route::prefix('categories')->group(function () {
    Route::get('/', [
        CategoriesController::class, 'index'
        ])
        ->name('categories.index');

    Route::get('/create', [
        CategoriesController::class, 'create'
        ])
        ->name('categories.create');
});
