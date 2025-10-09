<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'editView'])->name('profile.edit');
Route::post('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');

Route::get('/payments', [App\Http\Controllers\PaymentController::class, 'index'])->name('payments');
Route::get('/payments/add', [App\Http\Controllers\PaymentController::class, 'addView'])->name('payments.add');
Route::post('/payments/add', [App\Http\Controllers\PaymentController::class, 'add'])->name('payments.add');
Route::get('/payments/edit/{id}', [App\Http\Controllers\PaymentController::class, 'editView'])->name('payments.edit');
Route::post('/payments/edit', [App\Http\Controllers\PaymentController::class, 'edit'])->name('payments.edit');
Route::post('/payments/delete', [App\Http\Controllers\PaymentController::class, 'delete'])->name('payments.delete');