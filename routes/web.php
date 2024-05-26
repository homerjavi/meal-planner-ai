<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    $user = App\Models\User::find(1);
    dd(
        [auth()->id() => auth()->user()->name]
    );
})->name('test');

Route::get('/login', function () {
    return redirect(route('filament.admin.auth.login'));
})->name('login');
