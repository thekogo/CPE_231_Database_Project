<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function home()
    {
        $courses = Course::where('status', 1)->with('user')->get();
        return Inertia::render('Home', [
            "courses" => $courses
        ]);
    }

    public function index()
    {
        return Inertia::render('Welcome');
    }

    public function contact()
    {
        return Inertia::render('Contact');
    }
}
