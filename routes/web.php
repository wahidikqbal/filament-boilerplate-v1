<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/form', function () {
    return view('form');
});

Route::get('/{user:slug}', [MenuController::class, 'show'])->name('menu');

// Route::get('/{user:slug}', function (\App\Models\User $user) {
//     return view('form', ['user' => $user]);
// })->name('form');
