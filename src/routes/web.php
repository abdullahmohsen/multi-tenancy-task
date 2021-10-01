<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TenancyController;
use App\Http\Controllers\DepartmentController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::get('tenancies/create', [TenancyController::class, 'create'])->name('tenancy.create');
Route::post('tenancies/create', [TenancyController::class, 'store'])->name('tenancy.store');

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
  Route::prefix('departments')->group(function () {
    Route::get('/', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('create', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('edit/{id}', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::post('edit/{id}', [DepartmentController::class, 'update'])->name('departments.update');
    Route::post('delete/{id}', [DepartmentController::class, 'delete'])->name('departments.delete');
  });

  Route::prefix('employees')->group(function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('create', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('edit/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::post('edit/{id}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::post('delete/{id}', [EmployeeController::class, 'delete'])->name('employees.delete');
  });

  Route::prefix('tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('create', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('edit/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::post('edit/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::post('delete/{id}', [TaskController::class, 'delete'])->name('tasks.delete');
  });
});