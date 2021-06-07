<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Review;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseController extends Controller
{
    public function viewAllCourses()
    {
        $courses = Course::where('status', 1)->get();
        return Inertia::render('Home/Course/viewAllCourses', [
            'courses' => $courses
        ]);
    }

    public function viewDetailCourse($course_id)
    {
        $course = Course::with('user')->with('course_categories.category')->findOrFail($course_id);
        $enrollmentsCount = Enrollment::where('payment_status', 'success')->where('course_id', $course_id)->count();
        return Inertia::render('Home/Course/ViewDetailCourse', [
            "course" => $course,
            "enrollment_count" => $enrollmentsCount
        ]);
    }
}
