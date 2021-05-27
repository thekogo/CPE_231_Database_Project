<?php

use App\Http\Controllers\Student;
use App\Http\Controllers\Tutor;
use App\Http\Controllers\Admin;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware(['role:student'])->prefix('student')->group(function () {
        Route::get('/', [Student\HomeController::class, 'index'])->name('student.home');
    });
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware(['role:tutor'])->prefix('tutors')->group(function () {
        Route::get('/', [Tutor\HomeController::class, 'index']);
    });
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware(['role:admin'])->prefix('admins')->name('admin.')->group(function () {
        Route::get('/', [Admin\HomeController::class, 'index'])->name('home');
        Route::resource('/categories', Admin\CategoryController::class);
    });
});
