<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enrollments = Enrollment::where('user_id', Auth::id())->with('course')->get();
        return Inertia::render('Student/Enrollment/Home', [
            'enrollments' => $enrollments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

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
        $enrollment = Enrollment::where('user_id', Auth::id())->with('course')->findOrFail($id);
        return Inertia::render('Student/Enrollment/Show', [
            'enrollment' => $enrollment
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
        $enrollment = Enrollment::where('user_id', Auth::id())->with('course')->findOrFail($id);
        return Inertia::render('Student/Enrollment/Edit', [
            'enrollment' => $enrollment
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
        Validator::make($request->only('receipt_img'), [
            'receipt_img' => ['image'],
        ])->validate();

        $input = $request->only('receipt_img');
        $path = Enrollment::createReceiptImg($input['receipt_img']);

        $input['receipt_img'] = $path;

        $enrollment = Enrollment::where('user_id', Auth::id())->findOrFail($id);
        $enrollment->update($input);

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
        //
    }

    public function buyCourseView($course_id)
    {
        if (Enrollment::where('course_id', $course_id)->where('user_id', Auth::id())->exists())
            return redirect(route('student.enrollments.index'));
        $course = Course::with('user')->findOrFail($course_id);
        return inertia::render('Student/BuyCourse', [
            "course" => $course
        ]);
    }

    public function buyCourse(Request $request, $course_id)
    {
        if (Enrollment::where('course_id', $course_id)->where('user_id', Auth::id())->exists())
            return redirect(route('student.enrollments.index'));

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

        $input = $request->all();
        $input['receipt_img'] = $path;

        Enrollment::create($input);

        return redirect()->back();
    }
}
