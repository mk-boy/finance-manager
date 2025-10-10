<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/home');
})->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->middleware('auth')->name('profile');
Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'editView'])->middleware('auth')->name('profile.edit');
Route::post('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');

Route::get('/payments', [App\Http\Controllers\PaymentController::class, 'index'])->middleware('auth')->name('payments');
Route::get('/payments/add', [App\Http\Controllers\PaymentController::class, 'addView'])->middleware('auth')->name('payments.add');
Route::post('/payments/add', [App\Http\Controllers\PaymentController::class, 'add'])->name('payments.add');
Route::get('/payments/edit/{id}', [App\Http\Controllers\PaymentController::class, 'editView'])->middleware('auth')->name('payments.edit');
Route::post('/payments/edit', [App\Http\Controllers\PaymentController::class, 'edit'])->name('payments.edit');
Route::post('/payments/delete', [App\Http\Controllers\PaymentController::class, 'delete'])->name('payments.delete');

Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->middleware('auth')->name('categories');
Route::get('/categories/add', [App\Http\Controllers\CategoryController::class, 'addView'])->middleware('auth')->name('categories.add');
Route::post('/categories/add', [App\Http\Controllers\CategoryController::class, 'add'])->name('categories.add');
Route::get('/categories/edit/{id}', [App\Http\Controllers\CategoryController::class, 'editView'])->middleware('auth')->name('categories.edit');
Route::post('/categories/edit', [App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit_post');
Route::post('/categories/delete', [App\Http\Controllers\CategoryController::class, 'delete'])->name('categories.delete');