<?php

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

//Route::domain('{tenant}.localhost')->middleware('tenant')->group(function () {
//  Route::get('/', function ($tenant) {
//    return $tenant;
//  });
//});

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
    Route::get('show/{id}', [DepartmentController::class, 'show'])->name('departments.show');
    Route::get('create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('create', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('edit/{id}', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::post('edit/{id}', [DepartmentController::class, 'update'])->name('departments.update');
    Route::post('delete/{id}', [DepartmentController::class, 'delete'])->name('departments.delete');
  });
});