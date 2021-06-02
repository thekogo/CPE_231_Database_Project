<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::with('user')->get();
        return Inertia::render('Admin/Course/Home', [
            "courses" => $courses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tutors = User::where('role', 'tutor')->get();
        // dd($tutors);
        return Inertia::render('Admin/Course/Create', [
            "tutors" => $tutors
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
            'course_name' => ['required', 'string', 'unique:courses'],
            'course_description' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'course_status' => ['required', 'string'],
            'expire_date' => ['required', 'date'],
            'hours_left' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
            'course_img' => ['image'],
        ])->validate();

        $path = null;
        if (isset($request["course_img"])) {
            $path = Course::createCourseImg($request["course_img"]);
        }

        $request->merge([
            'create_date' => date("Y-m-d"),
            'course_img' => $path,
        ]);

        $input = $request->all();
        $input["course_img"] = $path;

        Course::create($input);

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
        $course = Course::with('user')->findOrFail($id);
        // dd($course);
        return Inertia::render('Admin/Course/Show', [
            "course" => $course,
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
        Course::findOrFail($id)->delete();

        return redirect()->back();
    }
}
