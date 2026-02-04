<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('/student/dashboard', function () {
        return view('student.dashboard');
    })->middleware('role:student');

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('role:admin');

});

require __DIR__.'/auth.php';