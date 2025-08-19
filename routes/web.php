<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Sms\EmployeeController;
use App\Http\Controllers\Sms\ProductController;
use App\Http\Controllers\Sms\VehicleController;
use App\Http\Controllers\Sms\PortfolioController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('backend.dashboard');
    //return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// custom auth login route
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

require __DIR__.'/auth.php';

// template dashboard
//Route::get('/dashboard', [dashboardController::class, 'dashboard'])->name('dashboard');

//sms emplyee
Route::get('/employee/list', [EmployeeController::class, 'index'])->name('employee.list');
Route::get('/employee/create', [EmployeeController::class, 'createForm'])->name('employee.create');
Route::post('/employee/save', [EmployeeController::class, 'store'])->name('employee.save');
Route::get('/employee/edit/{id}', [EmployeeController::class, 'editForm'])->name('employee.edit');
Route::get('/employee/view/{id}', [EmployeeController::class, 'view'])->name('employee.view');
Route::post('/employee/update', [EmployeeController::class, 'update'])->name('employee.update');
Route::get('/employee/delete/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

//sms product
Route::get('/product/list', [ProductController::class, 'index'])->name('product.list');
Route::get('/product/create', [ProductController::class, 'createForm'])->name('product.create');
Route::post('/product/save', [ProductController::class, 'store'])->name('product.save');
Route::get('/product/edit/{id}', [ProductController::class, 'editForm'])->name('product.edit');
Route::get('/product/view/{id}', [ProductController::class, 'view'])->name('product.view');
Route::post('/product/update', [ProductController::class, 'update'])->name('product.update');
Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

//sms portfolio
Route::get('/portfolio/list', [PortfolioController::class, 'index'])->name('portfolio.list');
Route::get('/portfolio/create', [PortfolioController::class, 'createForm'])->name('portfolio.create');
Route::post('/portfolio/save', [PortfolioController::class, 'store'])->name('portfolio.save');
Route::get('/portfolio/edit/{id}', [PortfolioController::class, 'editForm'])->name('portfolio.edit');
Route::post('/portfolio/update', [PortfolioController::class, 'update'])->name('portfolio.update');
Route::get('/portfolio/delete/{id}', [PortfolioController::class, 'destroy'])->name('portfolio.destroy');

//sms vehicle
Route::get('/vehicle/list', [VehicleController::class, 'index'])->name('vehicle.list');
Route::get('/vehicle/create', [VehicleController::class, 'createForm'])->name('vehicle.create');
Route::post('/vehicle/save', [VehicleController::class, 'store'])->name('vehicle.save');
Route::get('/vehicle/edit/{id}', [VehicleController::class, 'editForm'])->name('vehicle.edit');
Route::get('/vehicle/view/{id}', [VehicleController::class, 'view'])->name('vehicle.view');
Route::post('/vehicle/update', [VehicleController::class, 'update'])->name('vehicle.update');
Route::get('/vehicle/delete/{id}', [VehicleController::class, 'destroy'])->name('vehicle.destroy');

Route::get('/old-vehicle/list', [VehicleController::class, 'oldVehicle'])->name('old-vehicle.list');
Route::get('/emp-wise-vehicle/list', [VehicleController::class, 'empWiseVehicle'])->name('emp-wise-vehicle.list');
Route::post('/vehicle/update-status', [VehicleController::class, 'updateStatus'])->name('vehicle.update-status');
