<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProfileController as ProfileOfAdminController;
use App\Http\Controllers\Admin\CreatedShiftController;
use App\Http\Controllers\Admin\CompanyMembershipController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware(['auth:admin', 'verified'])->name('dashboard');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/profile', [ProfileOfAdminController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileOfAdminController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileOfAdminController::class, 'destroy'])->name('profile.destroy');
        Route::get('/shift', [CreatedShiftController::class, 'show'])->name('shift.show');
        Route::post('/shift', [CreatedShiftController::class, 'store'])->name('shift.store');
        Route::get('/employees', [CompanyMembershipController::class, 'index'])->name('employees.index');
        Route::get('/employees/create', [CompanyMembershipController::class, 'create'])->name('employees.create');
        Route::post('/employees', [CompanyMembershipController::class, 'store'])->name('employees.store');
        Route::get('/employees/{id}', [CompanyMembershipController::class, 'edit'])->name('employees.edit');
        Route::post('/employees/{id}', [CompanyMembershipController::class, 'update'])->name('employees.update');
        Route::post('/employees/{id}/destroy', [CompanyMembershipController::class, 'destroy'])->name('employees.destroy');
    });

    require __DIR__.'/admin.php';
});

