<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProfileController as ProfileOfAdminController;
use App\Http\Controllers\ConfirmShiftController;
use App\Http\Controllers\RequestedShiftController;
use App\Http\Controllers\UpdateDefaultTimeController;
use App\Http\Controllers\Admin\CreatedShiftController;
use App\Http\Controllers\Admin\CompanyMembershipController;
use App\Http\Controllers\Admin\UpdateCompanyNameController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ContactController as ContactOfAdminController;
use App\Http\Controllers\Admin\NotificationDeadlineSettingController;
use App\Http\Controllers\Admin\ShiftIntervalSettingController;

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

// お問い合わせデータの保存とメール自動送信
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// スタッフ側トップページ
Route::get('/', function () {
    return view('top');
})->name('top');

// スタッフ側ルート情報
Route::get('/shift', [ConfirmShiftController::class, 'index'])->middleware(['auth', 'verified'])->name('shift.index');

Route::middleware('auth')->group(function () {
    // 設定画面
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post("/default-time", [UpdateDefaultTimeController::class, 'update'])->name('default-time.update');

    // シフト提出画面
    Route::get('/submit-shift', [RequestedShiftController::class, 'index'])->name('submit-shift.index');
    Route::post('/submit-shift', [RequestedShiftController::class, 'store'])->name('submit-shift.store');

    // お問い合わせ画面
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
});

require __DIR__.'/auth.php';

// 管理者側トップページ
Route::get('/admin', function () {
    return view('admin.top');
})->name('admin.top');

// 管理者側ルート情報
Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/shift', [CreatedShiftController::class, 'index'])->middleware(['auth:admin', 'verified'])->name('shift.index');

    Route::middleware('auth:admin')->group(function () {
        Route::post('/shift', [CreatedShiftController::class, 'store'])->name('shift.store');

        // 設定画面
        Route::get('/profile', [ProfileOfAdminController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileOfAdminController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileOfAdminController::class, 'destroy'])->name('profile.destroy');
        Route::post('/company-name', [UpdateCompanyNameController::class, 'update'])->name('company-name.update');
        Route::post('/shift-interval', [ShiftIntervalSettingController::class, 'update'])->name('shift-interval.update');
        Route::post('/notification-deadline', [NotificationDeadlineSettingController::class, 'update'])->name('notification-deadline.update');

        // スタッフ管理画面
        Route::prefix('employees')->name('employees.')->group(function () {
        Route::get('/', [CompanyMembershipController::class, 'index'])->name('index');
        Route::get('/create', [CompanyMembershipController::class, 'create'])->name('create');
        Route::post('/', [CompanyMembershipController::class, 'store'])->name('store');
        Route::get('/{id}', [CompanyMembershipController::class, 'edit'])->name('edit');
        Route::post('/{id}', [CompanyMembershipController::class, 'update'])->name('update');
        Route::post('/{id}/destroy', [CompanyMembershipController::class, 'destroy'])->name('destroy');
        });

        // お問い合わせ画面
        Route::get('/contact', [ContactOfAdminController::class, 'index'])->name('contact.index');
    });

    require __DIR__.'/admin.php';
});

