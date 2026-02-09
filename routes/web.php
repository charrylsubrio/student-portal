<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {

    if (auth()->check()) {

        if (auth()->user()->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        return redirect('/student/dashboard');
    }

    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // ===============================
    // STUDENT DASHBOARD
    // ===============================
    Route::get('/student/dashboard', function () {
        return view('student.dashboard');
    })->middleware('role:student');


    // ===============================
    // ADMIN-ONLY ROUTES
    // ===============================
    Route::middleware('role:admin')->group(function () {

        // Admin dashboard
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        });

        // LIST USERS
        Route::get('/admin/users', [UserController::class, 'index'])
            ->name('admin.users');

        // CREATE USER
        Route::get('/admin/users/create', [UserController::class, 'create'])
            ->name('admin.users.create');

        Route::post('/admin/users', [UserController::class, 'store'])
            ->name('admin.users.store');

        // EDIT USER
        Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])
            ->name('admin.users.edit');

        Route::put('/admin/users/{user}', [UserController::class, 'update'])
            ->name('admin.users.update');

        // ===============================
        // DELETE USER  ← IMPORTANT
        // ===============================
        Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])
            ->name('admin.users.destroy');
    });

});

require __DIR__ . '/auth.php';
