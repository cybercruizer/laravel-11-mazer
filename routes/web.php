<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JamkerjaController;
use App\Http\Controllers\PengaturanController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/tesalert', function () {
    return view('tesalert');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/security', [ProfileController::class, 'security'])->name('profile.security');

    Route::group(['prefix' => 'component', 'as' => 'component.'], function() {
        Route::get('accordion', function() {
            return view('mazer.components.accordion');
        })->name('accordion');
    });

    Route::group(['prefix' => 'device', 'as' => 'device.'], function() {
        Route::get('/', [DeviceController::class, 'index'])->name('index');
        Route::post('store', [DeviceController::class, 'store'])->name('store');
        Route::get('edit/{id}', [DeviceController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [DeviceController::class, 'update'])->name('update');
        Route::delete('destroy/{id}', [DeviceController::class, 'destroy'])->name('destroy');
        
    });
    Route::group(['prefix' => 'jamkerja', 'as' => 'jamkerja.'], function() {
        Route::get('/', [JamkerjaController::class, 'index'])->name('index');
        Route::get('show/{id}', [JamkerjaController::class, 'show'])->name('show');
        Route::post('store', [JamkerjaController::class, 'store'])->name('store');
        Route::get('edit/{id}', [JamkerjaController::class, 'edit'])->name('edit');
        Route::post('update', [JamkerjaController::class, 'update'])->name('update');
        Route::delete('destroy/{id}', [JamkerjaController::class, 'destroy'])->name('destroy');
    });
    Route::group(['prefix' => 'pengaturan', 'as' => 'pengaturan.'], function() {
        Route::get('/', [PengaturanController::class, 'index'])->name('index');
        Route::post('store', [PengaturanController::class, 'store'])->name('store');
        Route::get('edit/{id}', [PengaturanController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [PengaturanController::class, 'update'])->name('update');
    });
});

require __DIR__.'/auth.php';
