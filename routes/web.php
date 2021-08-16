<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/user-profile', function(){ return view('user-profile'); } )->name('user-profile');
    Route::prefix('/users-management')->group(function(){
        Route::get('users', function(){ return view('admin.users.users');})->name('users-management.users');
        Route::resource('roles', App\Http\Controllers\Admin\RolesController::class);
        Route::get('permissions', function(){ return view('admin.users.permissions');})->name('users-management.permissions');
    });
});

Route::get('{any}', function () {
    return view('layouts.app');
})->where('any', '.*');
