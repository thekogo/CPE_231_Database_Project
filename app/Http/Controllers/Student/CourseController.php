<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
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
        return Inertia::render('Student/Course/ViewAllCourse');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        return Inertia::render('Student/Course/ViewOneCourse');
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

    public function buyCourseView($course_id)
    {
        $course = Course::with('user')->findOrFail($course_id);
        return inertia::render('Student/BuyCourse', [
            "course" => $course
        ]);
    }

    public function buyCourse(Request $request, $course_id)
    {
        Validator::make($request->all(), [
            'receipt_img' => ['image'],
        ])->validate();

        $path = Enrollment::createReceiptImg($request['receipt_img']);
        $request->merge([
            'receipt_img' => $path,
            'payment_method' => "ช่องทางออนไลน์",
            'payment_date' => date("Y-m-d"),
            'payment_status' => "รอดำเนินการ",
            'enroll_date' => null,
            'user_id' => Auth::id(),
            'course_id' => $course_id
        ]);

        Enrollment::create($request->all());

        return redirect()->back();
    }
}
