<?php

use App\Http\Controllers\Student;
use App\Http\Controllers\Tutor;
use App\Http\Controllers\Admin;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\UserController;
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

Route::prefix('home')->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::get('/courses', [CourseController::class, 'viewAllCourses'])->name('course.all');
    Route::get('/courses/{course}', [CourseController::class, 'viewDetailCourse'])->name('course.detail');
    Route::get('/tutors', [TutorController::class, 'viewAllTutors'])->name('tutor.all');
    Route::get('/tutors/{tutor}', [TutorController::class, 'viewDetailTutor'])->name('tutor.detail');
});


Route::middleware(['auth:sanctum', 'verified'])->put('/updateEducation', [UserController::class, 'updateEducation'])->name('user-profile-education.update');
Route::middleware(['auth:sanctum', 'verified'])->put('/createEducation', [UserController::class, 'createEducation'])->name('user-profile-education.create');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware(['role:student'])->prefix('students')->name('student.')->group(function () {
        Route::get('/', [Student\HomeController::class, 'index'])->name('home');
        Route::resource('courses', Student\CourseController::class);
        Route::get('/buycourse/{course}', [Student\EnrollmentController::class, 'buyCourseView'])->name('buycourse');
        Route::post('/buycourse/{course}', [Student\EnrollmentController::class, 'buyCourse'])->name('buycourse.create');
        Route::resource('enrollments', Student\EnrollmentController::class)->except(['create', 'store']);
        Route::resource('courses.lessons', Student\LessonController::class);
        Route::resource('courses.lessons.questions', Student\QuestionController::class);
        Route::resource('courses.lessons.lesson_histories', Student\LessonHistoryController::class);
        Route::resource('reserves', Student\ReserveController::class);
        Route::resource('courses.reviews', Student\ReviewController::class);
    });
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware(['role:tutor'])->prefix('tutors')->name('tutor.')->group(function () {
        Route::get('/', [Tutor\HomeController::class, 'index'])->name('home');
        Route::resource('courses', Tutor\CourseController::class);
        Route::resource('courses.lessons', Tutor\LessonController::class);
        Route::resource('courses.lessons.questions', Tutor\QuestionController::class);
        Route::resource('courses.lessons.faqs', Tutor\FAQController::class);
        Route::resource('courses.lessons.questions.answers', Tutor\AnswerController::class);
        Route::resource('courses.students', Tutor\StudentController::class);
    });
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware(['role:admin'])->prefix('admins')->name('admin.')->group(function () {
        Route::get('/', [Admin\AnalyticController::class, 'index'])->name('home');
        Route::resource('categories', Admin\CategoryController::class);
        Route::resource('courses', Admin\CourseController::class);
        Route::resource('enrollments', Admin\EnrollmentController::class);
        Route::resource('courses.lessons', Admin\LessonController::class);
        Route::resource('courses.students', Admin\StudentController::class);
        Route::resource('courses.lessons.faqs', Admin\FAQController::class);
        Route::resource('courses.lessons.questions.answers', Admin\AnswerController::class);
        Route::resource('reserves', Admin\ReserveController::class);
        Route::get('/analytics', [Admin\AnalyticController::class, 'index']);
    });
});
