<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndexController;

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', [IndexController::class, 'callHome'])->name('home');

Route::get('/users', [UserController::class, 'index'])->name('user.user');
Route::post('/users', [UserController::class, 'createUser'])->name('createUser');
Route::get('/users/delete/{id}', [UserController::class, 'deleteUserId'])->name('deleteUser');

Route::get('/gifts', [GiftController::class, 'index'])->name('gifts.gifts');
Route::post('/gifts', [GiftController::class, 'createGift'])->name('createGift');
Route::get('/gifts/delete/{id}', [GiftController::class, 'deleteGift'])->name('deleteGift');

Route::fallback(function () {
    return view('notFound');
});
