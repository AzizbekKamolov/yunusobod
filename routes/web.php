<?php

use App\Http\Controllers\{AuthController, DashboardController, PermissionController, RoleController, UserController};
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::get('/login', 'index')->name('web.login');
    Route::post('login', 'login')->name('web.loginPost');
});

Route::middleware(['auth', 'lang'])->prefix('admin')->group(function () {
    Route::controller(DashboardController::class)->name('dashboard.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('change-lang/{lang}', 'changeLang')->name('changeLang');
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

    // Permissions
    Route::controller(PermissionController::class)->name('permissions.')->prefix('permissions')->group(function () {
        Route::get('index', 'index')->name('index')->can('permissions.index');
        Route::get('create', 'create')->name('create')->can('permissions.store');
        Route::post('/store', 'store')->name('store')->can('permissions.store');
        Route::get('edit/{id}', 'edit')->name('edit')->can('permissions.update');
        Route::put('/update/{id}', 'update')->name('update')->can('permissions.update');
        Route::get('delete/{id}', 'delete')->name('delete')->can('permissions.delete');
    });

    // Roles
    Route::controller(RoleController::class)->name('roles.')->prefix('roles')->group(function () {
        Route::get('index', 'index')->name('index')->can('roles.index');
        Route::get('new', 'new')->name('new');
        Route::post('store', 'store')->name('store')->can('roles.store');
        Route::get('create', 'create')->name('create')->can('roles.store');
        Route::put('update/{id}', 'update')->name('update')->can('roles.update');
        Route::get('edit/{id}', 'edit')->name('edit')->can('roles.update');
        Route::get('delete/{id}', 'delete')->name('delete')->can('roles.delete');
    });

    //users
    Route::controller(UserController::class)->name('users.')->prefix('users')->group(function () {
        Route::get('index', 'index')->name('index')->can('users.index');
        Route::post('store', 'store')->name('store')->can('users.store');
        Route::get('create', 'create')->name('create')->can('users.store');
        Route::get('updateProfile', 'updateProfile')->name('updateProfile');
        Route::put('update/{id}', 'update')->name('update')->can('users.update');
        Route::get('edit/{id}', 'edit')->name('edit')->can('users.update');
        Route::get('delete/{id}', 'delete')->name('delete')->can('users.delete');
    });
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');

});
