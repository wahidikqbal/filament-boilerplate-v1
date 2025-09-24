<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/form', function () {
    return view('form');
});

// Route::get('/{user:slug}', function (\App\Models\User $user) {
//     return view('form', ['user' => $user]);
// })->name('form');

Route::get('/{slug}', function ($slug) {
    $user = \App\Models\User::where('slug', $slug)->firstOrFail();
    return view('form', compact('user'));
});