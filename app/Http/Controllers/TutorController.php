<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TutorController extends Controller
{
    public function viewAllCourses()
    {
        return Inertia::render('Home/Tutor/viewAllTutors');
    }

    public function viewDetailCourse($course_id)
    {
        return Inertia::render('Home/Tutor/ViewDetailTutor');
    }
}
