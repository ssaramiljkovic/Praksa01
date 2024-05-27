<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/admin/create-manager', [UserController::class, 'createManagerForm'])->name('admin.create-manager');
Route::post('/admin/store-manager', [UserController::class, 'storeManager'])->name('admin.store-manager');


Route::get('/see-users', [UserController::class, 'seeUsers'])->name('see-users');


require __DIR__.'/auth.php';
