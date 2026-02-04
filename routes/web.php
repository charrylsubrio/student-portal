<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/student/dashboard', function () {
        return view('student.dashboard');
    })->middleware(RoleMiddleware::class . ':student');

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->middleware(RoleMiddleware::class . ':admin');

});

require __DIR__ . '/auth.php';
