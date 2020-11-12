<?php

use App\Http\Controllers\AdminCarsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminMechanicsController;
use App\Http\Controllers\AdminToolsController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::post('/profile/edit', [ProfileController::class, 'update']);

    Route::get('/car/create', [CarController::class, 'create'])->name('car.create');

    Route::post('/car/create', [CarController::class, 'store'])->name('car.store');

    Route::get('/request/create', [ServiceController::class, 'create'])->name('request.create');

    Route::post('/request/create', [ServiceController::class, 'store'])->name('request.store');

    Route::get('/repairs', [RepairController::class, 'index'])->name('repairs.index');

    Route::middleware(CheckAdmin::class)->group(function () {
        Route::get('/admin', AdminController::class)->name('admin.panel');

        Route::get('/admin/users', [AdminUsersController::class, 'index'])->name('admin.users.index');

        Route::get('/admin/users/create', [AdminUsersController::class, 'create'])->name('admin.users.create');

        Route::post('/admin/users', [AdminUsersController::class, 'store'])->name('admin.users.store');

        Route::get('/admin/users/{user}', [AdminUsersController::class, 'show'])->name('admin.users.show');

        Route::delete('/admin/users/{user}', [AdminUsersController::class, 'destroy'])->name('admin.users.destroy');

        Route::get('/admin/all_mechanics/{orderBy?}', [AdminMechanicsController::class, 'index'])->name('admin.mechanics.index');

        Route::get('/admin/mechanics/create', [AdminMechanicsController::class, 'create'])->name('admin.mechanics.create');

        Route::post('/admin/mechanics', [AdminMechanicsController::class, 'store'])->name('admin.mechanics.store');

        Route::get('/admin/mechanics/{mechanic}', [AdminMechanicsController::class, 'show'])->name('admin.mechanics.show');

        Route::get('/admin/mechanics/{mechanic}/edit', [AdminMechanicsController::class, 'edit'])->name('admin.mechanics.edit');

        Route::patch('/admin/mechanics/{mechanic}', [AdminMechanicsController::class, 'update'])->name('admin.mechanics.update');

        Route::delete('/admin/mechanics/{mechanic}', [AdminMechanicsController::class, 'destroy'])->name('admin.mechanics.destroy');

        Route::get('/admin/tools', [AdminToolsController::class, 'index'])->name('admin.tools.index');

        Route::get('/admin/tools/create', [AdminToolsController::class, 'create'])->name('admin.tools.create');

        Route::post('/admin/tools', [AdminToolsController::class, 'store'])->name('admin.tools.store');

        Route::get('/admin/tools/{tool}', [AdminToolsController::class, 'show'])->name('admin.tools.show');

        Route::get('/admin/tools/{tool}/edit', [AdminToolsController::class, 'edit'])->name('admin.tools.edit');

        Route::patch('/admin/tools/{tool}', [AdminToolsController::class, 'update'])->name('admin.tools.update');

        Route::delete('/admin/tools/{tool}', [AdminToolsController::class, 'destroy'])->name('admin.tools.destroy');

        Route::get('/admin/all_cars/{orderBy?}', [AdminCarsController::class, 'index'])->name('admin.cars.index');

        Route::get('/admin/cars/create', [AdminCarsController::class, 'create'])->name('admin.cars.create');

        Route::post('/admin/cars', [AdminCarsController::class, 'store'])->name('admin.cars.store');

        Route::delete('/admin/cars/{car}', [AdminCarsController::class, 'destroy'])->name('admin.cars.destroy');
    });
});
