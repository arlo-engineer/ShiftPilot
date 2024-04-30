<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProfileController as ProfileOfAdminController;
use App\Http\Controllers\ConfirmShiftController;
use App\Http\Controllers\RequestedShiftController;
use App\Http\Controllers\Admin\CreatedShiftController;
use App\Http\Controllers\Admin\CompanyMembershipController;
use App\Http\Controllers\Admin\SettingsController;
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

// スタッフ側ルート情報
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/shift', [ConfirmShiftController::class, 'index'])->name('shift.index');
});

require __DIR__.'/auth.php';

// 管理者側ルート情報
Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/shift', [CreatedShiftController::class, 'index'])->middleware(['auth:admin', 'verified'])->name('shift.index');

    Route::middleware('auth:admin')->group(function () {
        Route::post('/shift', [CreatedShiftController::class, 'store'])->name('shift.store');
        Route::get('/profile', [ProfileOfAdminController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileOfAdminController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileOfAdminController::class, 'destroy'])->name('profile.destroy');

        Route::prefix('employees')->name('employees.')->group(function () {
        Route::get('/', [CompanyMembershipController::class, 'index'])->name('index');
        Route::get('/create', [CompanyMembershipController::class, 'create'])->name('create');
        Route::post('/', [CompanyMembershipController::class, 'store'])->name('store');
        Route::get('/{id}', [CompanyMembershipController::class, 'edit'])->name('edit');
        Route::post('/{id}', [CompanyMembershipController::class, 'update'])->name('update');
        Route::post('/{id}/destroy', [CompanyMembershipController::class, 'destroy'])->name('destroy');
        });

        Route::get('/settings', [SettingsController::class, 'edit'])->name('setting.edit');
        Route::post('/settings', [SettingsController::class, 'update'])->name('setting.update');
    });

    require __DIR__.'/admin.php';
});

