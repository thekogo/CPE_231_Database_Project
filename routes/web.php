<?php

use App\Http\Controllers\Student;
use App\Http\Controllers\Tutor;
use App\Http\Controllers\Admin;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Jetstream\Rules\Role;

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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/courses', [CourseController::class, 'viewAllCourses'])->name('course.all');
Route::get('/courses/{course}', [CourseController::class, 'viewDetailCourse'])->name('course.detail');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware(['role:student'])->prefix('students')->group(function () {
        Route::get('/', [Student\HomeController::class, 'index'])->name('student.home');
        Route::resource('/courses', Student\CourseController::class);
        Route::get('/buycourse/{course}', [Student\CourseController::class, 'buyCourseView'])->name('buycourse');
    });
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware(['role:tutor'])->prefix('tutors')->name('tutor.')->group(function () {
        Route::get('/', [Tutor\HomeController::class, 'index'])->name('home');
        Route::resource('/courses', Tutor\CourseController::class);
        Route::resource('courses.lessons', Tutor\LessonController::class);
        Route::resource('courses.lessons.questions', Tutor\QuestionController::class);
    });
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware(['role:admin'])->prefix('admins')->name('admin.')->group(function () {
        Route::get('/', [Admin\HomeController::class, 'index'])->name('home');
        Route::resource('/categories', Admin\CategoryController::class);
        Route::resource('/courses', Admin\CourseController::class);
        Route::resource('/enrollments', Admin\EnrollmentController::class);
        Route::resource('courses.lessons', Admin\LessonController::class);
    });
});
