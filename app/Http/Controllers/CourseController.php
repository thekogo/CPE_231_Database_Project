<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseController extends Controller
{
    public function viewAllCourses()
    {
        return Inertia::render('Course/viewAllCourses');
    }

    public function viewDetailCourse($course_id)
    {
        $course = Course::with('user')->findOrFail($course_id);
        return Inertia::render('Course/ViewDetailCourse', [
            "course" => $course
        ]);
    }
}
