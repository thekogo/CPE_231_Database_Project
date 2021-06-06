<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enrollments = Enrollment::with('user')->with('course')->get();
        return Inertia::render('Admin/Enrollment/Home', [
            "enrollments" => $enrollments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = User::where('role', 'student')->get();
        $courses = Course::all();
        return Inertia::render('Admin/Enrollment/Create', [
            "students" => $students,
            "courses" => $courses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'user_id' => ['required', 'integer'],
            'course_id' => ['required', 'integer'],
            'payment_method' => ['required', 'string'],
            'payment_date' => ['required', 'date'],
            'payment_status' => ['required', 'string'],
        ])->validate();
        Enrollment::create(array_merge($request->all(), [
            'enroll_date' => date("Y-m-d")
        ]));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $students = User::where('role', 'student')->get();
        $courses = Course::all();
        return Inertia::render('Admin/Enrollment/Show', [
            "enrollment" => $enrollment,
            "students" => $students,
            "courses" => $courses,
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
        $enrollment = Enrollment::findOrFail($id);
        $students = User::where('role', 'student')->get();
        $courses = Course::all();
        return Inertia::render('Admin/Enrollment/Edit', [
            "enrollment" => $enrollment,
            "students" => $students,
            "courses" => $courses,
        ]);
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
        Validator::make($request->all(), [
            'user_id' => ['required', 'integer'],
            'course_id' => ['required', 'integer'],
            'payment_method' => ['required', 'string'],
            'payment_date' => ['required', 'date'],
            'payment_status' => ['required', 'string'],
        ])->validate();

        $enrollment = Enrollment::findOrFail($id);
        $enrollment->update($request->all());

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Enrollment::findOrFail($id)->delete();

        return redirect()->back();
    }
}
