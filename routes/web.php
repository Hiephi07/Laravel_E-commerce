<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\MenusController;

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

    Route::post('/store', [
        CategoriesController::class, 'store'
        ])
        ->name('categories.store');

    Route::get('/edit/{id}', [
        CategoriesController::class, 'edit'
        ])
        ->name('categories.edit');

    Route::post('/update/{id}', [
        CategoriesController::class, 'update'
        ])
        ->name('categories.update');

    Route::get('/delete/{id}', [
        CategoriesController::class, 'delete'
        ])
        ->name('categories.delete');
});

Route::prefix('menus')->group(function () {
    Route::get('/', [MenusController::class, "index"])
    ->name("menus.index");

    Route::get('/create', [MenusController::class, "create"])
    ->name("menus.create");

    Route::post('/store', [MenusController::class, "store"])
    ->name("menus.store");

    Route::get('/edit/{id}', [MenusController::class, "edit"])
    ->name("menus.edit");

    Route::post('/update/{id}', [MenusController::class, "update"])
    ->name("menus.update");

    Route::get('/delete/{id}', [MenusController::class, "delete"])
    ->name("menus.delete");
});
