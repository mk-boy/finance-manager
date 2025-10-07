<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', function () {
    return redirect('/profile');
})->name('home');

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'editView'])->name('profile.edit');
Route::post('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
