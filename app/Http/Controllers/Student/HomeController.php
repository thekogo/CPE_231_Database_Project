<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\LessonHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::where('user_id', Auth::id())->pluck('id')->toArray();
        $last_lesson = LessonHistory::whereIn('enrollment_id', $enrollments)
            ->orderBy('finish_date')->with('lesson.course')->first();

        $enrollments = Enrollment::where('user_id', Auth::id())->with('course')->limit(3)->get();
        // dd($courses);
        return Inertia::render('Student/Home', [
            'last_lesson' => $last_lesson,
            'enrollments' => $enrollments
        ]);
    }
}
