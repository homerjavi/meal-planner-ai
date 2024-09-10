<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return phpinfo();
    return view('welcome');
});

Route::get('/test', TestController::class)->name('test');

Route::get('/login', function () {
    return redirect(route('filament.admin.auth.login'));
})->name('login');
