<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\ServiceController;
use App\Http\Middleware\CheckAdmin;
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

Route::get('/', HomeController::class)->name('home');

Route::get('/contacts', ContactsController::class)->name('contacts');

Route::get('/services/{category?}', [ServiceController::class, 'index'])->name('services.index');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');

    Route::post('/login', [AuthController::class, 'loginCheck']);

    Route::get('/register', [AuthController::class, 'register'])->name('register');

    Route::post('/register', [AuthController::class, 'registerCheck']);
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');

    Route::get('/car/create', [CarController::class, 'create'])->name('car.create');

    Route::post('/car/create', [CarController::class, 'store'])->name('car.store');

    Route::get('/request/create', [ServiceController::class, 'create'])->name('request.create');

    Route::post('/request/create', [ServiceController::class, 'store'])->name('request.store');

    Route::get('/repairs', [RepairController::class, 'index'])->name('repairs.index');

    Route::middleware(CheckAdmin::class)->group(function () {
        Route::get('/admin', [AdminController::class, 'panel'])->name('admin.panel');
    });
});
