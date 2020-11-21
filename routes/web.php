<?php

use App\Http\Controllers\AdminCarsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminMechanicsController;
use App\Http\Controllers\AdminRequestsRepairsController;
use App\Http\Controllers\AdminServicesController;
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

    Route::middleware('admin')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('', AdminController::class)->name('admin.panel');

            Route::get('users', [AdminUsersController::class, 'index'])->name('admin.users.index');

            Route::get('users/create', [AdminUsersController::class, 'create'])->name('admin.users.create');

            Route::post('users', [AdminUsersController::class, 'store'])->name('admin.users.store');

            Route::get('users/{user}', [AdminUsersController::class, 'show'])->name('admin.users.show');

            Route::delete('users/{user}', [AdminUsersController::class, 'destroy'])->name('admin.users.destroy');

            Route::get('all_mechanics/{orderBy?}', [AdminMechanicsController::class, 'index'])->name('admin.mechanics.index');

            Route::get('mechanics/create', [AdminMechanicsController::class, 'create'])->name('admin.mechanics.create');

            Route::post('mechanics', [AdminMechanicsController::class, 'store'])->name('admin.mechanics.store');

            Route::get('mechanics/{mechanic}', [AdminMechanicsController::class, 'show'])->name('admin.mechanics.show');

            Route::get('mechanics/{mechanic}/edit', [AdminMechanicsController::class, 'edit'])->name('admin.mechanics.edit');

            Route::patch('mechanics/{mechanic}', [AdminMechanicsController::class, 'update'])->name('admin.mechanics.update');

            Route::delete('mechanics/{mechanic}', [AdminMechanicsController::class, 'destroy'])->name('admin.mechanics.destroy');

            Route::get('tools', [AdminToolsController::class, 'index'])->name('admin.tools.index');

            Route::get('tools/create', [AdminToolsController::class, 'create'])->name('admin.tools.create');

            Route::post('tools', [AdminToolsController::class, 'store'])->name('admin.tools.store');

            Route::get('tools/{tool}', [AdminToolsController::class, 'show'])->name('admin.tools.show');

            Route::get('tools/{tool}/edit', [AdminToolsController::class, 'edit'])->name('admin.tools.edit');

            Route::patch('tools/{tool}', [AdminToolsController::class, 'update'])->name('admin.tools.update');

            Route::delete('tools/{tool}', [AdminToolsController::class, 'destroy'])->name('admin.tools.destroy');

            Route::get('all_cars/{orderBy?}', [AdminCarsController::class, 'index'])->name('admin.cars.index');

            Route::get('cars/create', [AdminCarsController::class, 'create'])->name('admin.cars.create');

            Route::post('cars', [AdminCarsController::class, 'store'])->name('admin.cars.store');

            Route::delete('cars/{car}', [AdminCarsController::class, 'destroy'])->name('admin.cars.destroy');

            Route::get('all_services/{category?}', [AdminServicesController::class, 'index'])->name('admin.services.index');

            Route::get('services/create', [AdminServicesController::class, 'create'])->name('admin.services.create');

            Route::post('services', [AdminServicesController::class, 'store'])->name('admin.services.store');

            Route::get('services/{service}/edit', [AdminServicesController::class, 'edit'])->name('admin.services.edit');

            Route::patch('services/{service}', [AdminServicesController::class, 'update'])->name('admin.services.update');

            Route::delete('services/{service}', [AdminServicesController::class, 'destroy'])->name('admin.services.destroy');

            Route::get('requests', [AdminRequestsRepairsController::class, 'index'])->name('admin.requests.index');

            Route::get('requests/word-export/{request}', [AdminRequestsRepairsController::class, 'document'])->name('document');

//        Route::get('tools/create', [AdminToolsController::class, 'create'])->name('admin.tools.create');
//
//        Route::post('tools', [AdminToolsController::class, 'store'])->name('admin.tools.store');
//
//        Route::get('tools/{tool}', [AdminToolsController::class, 'show'])->name('admin.tools.show');
//
            Route::get('repairs/{repair}/edit', [AdminRequestsRepairsController::class, 'edit'])->name('admin.repairs.edit');
//
            Route::patch('repairs/{repair}', [AdminRequestsRepairsController::class, 'update'])->name('admin.repairs.update');
//
//        Route::delete('tools/{tool}', [AdminToolsController::class, 'destroy'])->name('admin.tools.destroy');
        });
    });
});
