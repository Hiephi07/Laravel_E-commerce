<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminRoleController;

Route::get('/admin', [AdminController::class, 'loginAdmin']);
Route::post('/admin', [AdminController::class, 'postLoginAdmin']);
Route::post('/logout', [AdminController::class, 'logoutAdmin'])->name('logout');

// Route::get('/home', function () {
//     return view('home');
// });


Route::prefix('admin')->middleware('auth.admin')->group(function () {

    Route::prefix('categories')->group(function () {
        Route::get('/', [
            CategoriesController::class, 'index'
            ])
            ->name('categories.index')
            ->middleware('can:category-list');
    
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

    Route::prefix('products')->group(function () {
        Route::get('/', [AdminProductController::class, "index"])
        ->name("products.index");
    
        Route::get('/create', [AdminProductController::class, "create"])
        ->name("products.create");
    
        Route::post('/store', [AdminProductController::class, "store"])
        ->name("products.store");
    
        Route::get('/edit/{id}', [AdminProductController::class, "edit"])
        ->name("products.edit");
    
        Route::post('/update/{id}', [AdminProductController::class, "update"])
        ->name("products.update");
    
        Route::get('/delete/{id}', [AdminProductController::class, "delete"])
        ->name("products.delete");
    });

    // Users
    Route::prefix('users')->group(function () {
    
        Route::get('/', [
            AdminUserController::class,'index'
        ])->name('users.index');

        Route::get('/create', [
            AdminUserController::class,'create'
        ])->name('users.create');

        Route::post('/store', [
            AdminUserController::class,'store'
        ])->name('users.store');

        Route::get('/edit/{id}', [
            AdminUserController::class,'edit'
        ])->name('users.edit');

        Route::post('/update/{id}', [
            AdminUserController::class,'update'
        ])->name('users.update');

        Route::get('/delete/{id}', [
            AdminUserController::class,'delete'
        ])->name('users.delete');
    });

    // List Role
    Route::prefix('roles')->group(function () {
    
        Route::get('/', [
            AdminRoleController::class,'index'
        ])->name('roles.index');

        Route::get('/create', [
            AdminRoleController::class,'create'
        ])->name('roles.create');

        Route::post('/store', [
            AdminRoleController::class,'store'
        ])->name('roles.store');

        Route::get('/edit/{id}', [
            AdminRoleController::class,'edit'
        ])->name('roles.edit');

        Route::post('/update/{id}', [
            AdminRoleController::class,'update'
        ])->name('roles.update');

        Route::get('/delete/{id}', [
            AdminRoleController::class,'delete'
        ])->name('roles.delete');
    });
});


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});