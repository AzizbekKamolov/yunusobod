<?php

use App\Http\Controllers\{AuthController,
    DashboardController,
    DirectionController,
    EmployeeController,
    PermissionController,
    RoleController,
    SliderController,
    SocialNetworkController,
    UserController,
    WebController};
use Illuminate\Support\Facades\Route;

Route::controller(WebController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/about-us', 'about')->name('about');
    Route::get('/activity', 'activity')->name('activity');
    Route::get('/our-teams', 'ourTeams')->name('ourTeams');
    Route::get('/statistics', 'statistics')->name('statistics');
    Route::get('/partners', 'partners')->name('partners');
    Route::get('/contact', 'contact')->name('contact');

});

Route::view('/saved_resource', 'web.saved_resource');
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('login', 'login')->name('web.loginPost');
});
Route::controller(DashboardController::class)->name('dashboard.')->group(function () {
    Route::get('change-lang/{lang}', 'changeLang')->name('changeLang');
});
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::controller(DashboardController::class)->name('dashboard.')->group(function () {
        Route::get('/', 'index')->name('index');
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
    //sliders
    Route::controller(SliderController::class)->name('sliders.')->prefix('sliders')->group(function () {
        Route::get('/', 'index')->name('index')->can('sliders.index');
        Route::post('store', 'store')->name('store')->can('sliders.store');
        Route::get('create', 'create')->name('create')->can('sliders.store');
        Route::put('update/{id}', 'update')->name('update')->can('sliders.update');
        Route::get('set-order/{id}', 'setOrder')->name('setOrder')->can('sliders.update');
        Route::get('edit/{id}', 'edit')->name('edit')->can('sliders.update');
        Route::get('delete/{id}', 'delete')->name('delete')->can('sliders.delete');
    });
    //directions
    Route::controller(DirectionController::class)->name('directions.')->prefix('directions')->group(function () {
        Route::get('/', 'index')->name('index')->can('directions.index');
        Route::post('store', 'store')->name('store')->can('directions.store');
        Route::get('create', 'create')->name('create')->can('directions.store');
        Route::put('update/{id}', 'update')->name('update')->can('directions.update');
        Route::get('set-order/{id}', 'setOrder')->name('setOrder')->can('directions.update');
        Route::get('edit/{id}', 'edit')->name('edit')->can('directions.update');
        Route::get('delete/{id}', 'delete')->name('delete')->can('directions.delete');
    });
    //employees
    Route::controller(EmployeeController::class)->name('employees.')->prefix('employees')->group(function () {
        Route::get('/', 'index')->name('index')->can('employees.index');
        Route::post('store', 'store')->name('store')->can('employees.store');
        Route::get('create', 'create')->name('create')->can('employees.store');
        Route::put('update/{id}', 'update')->name('update')->can('employees.update');
        Route::get('set-order/{id}', 'setOrder')->name('setOrder')->can('employees.update');
        Route::get('edit/{id}', 'edit')->name('edit')->can('employees.update');
        Route::get('delete/{id}', 'delete')->name('delete')->can('employees.delete');
    });
    //employees
    Route::controller(SocialNetworkController::class)->name('social_networks.')->prefix('social-networks')->group(function () {
        Route::get('/', 'index')->name('index')->can('social_networks.index');
        Route::post('store', 'store')->name('store')->can('social_networks.store');
        Route::get('create', 'create')->name('create')->can('social_networks.store');
        Route::put('update/{id}', 'update')->name('update')->can('social_networks.update');
        Route::get('set-order/{id}', 'setOrder')->name('setOrder')->can('social_networks.update');
        Route::get('edit/{id}', 'edit')->name('edit')->can('social_networks.update');
        Route::get('delete/{id}', 'delete')->name('delete')->can('social_networks.delete');
    });
});
