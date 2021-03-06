<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enrollments = Enrollment::where('user_id', Auth::id())
            ->where('payment_status', 'success')
            ->with('course')->get();
        return Inertia::render('Student/Course/Home', [
            'enrollments' => $enrollments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $enrollment = Enrollment::where('user_id', Auth::id())
        //     ->where('payment_status', 'success')
        //     ->with('course')
        //     ->with('user')
        //     ->with('course.user')
        //     ->with(['course.lessons' => function ($query) {
        //         $query->orderBy('order');
        //     }])->findOrFail($id);
        $course = Course::with(['enrollments' => function ($query) {
            $query->where('user_id', Auth::id())
                ->where('payment_status', 'success');
        }])->with('user')->with(['lessons' => function ($query) {
            $query->orderBy('order');
        }])->findOrFail($id);
        $enrollment = Enrollment::where('user_id', Auth::id())->where('course_id', $course->id)->first();
        $is_reviewed = Review::where('enrollment_id', $enrollment->id)->exists();
        return Inertia::render('Student/Course/Show', [
            'course' => $course,
            'is_reviewed' => $is_reviewed
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
