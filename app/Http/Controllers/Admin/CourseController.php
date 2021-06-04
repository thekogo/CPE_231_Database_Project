<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        $categories = Category::all();
        return Inertia::render('Admin/Course/Create', [
            "tutors" => $tutors,
            "categories" => $categories
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
            'name' => ['required', 'string', 'unique:courses'],
            'description' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'status' => ['required', 'string'],
            'expire_date' => ['required', 'date'],
            'hours_left' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
            'course_img' => ['image', 'nullable'],
        ])->validate();

        $path = null;
        if ($request->file('course_img') != null) {
            $path = Course::createCourseImg($request["course_img"]);
        }

        $request->merge([
            'create_date' => date("Y-m-d"),
            'course_img' => $path,
        ]);

        $input = $request->all();
        $input["course_img"] = $path;

        $course = Course::create($input);

        Course::updateCourseCategories($request["selected_categories"], $course);

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
        $course = Course::with('user')
            ->with('course_categories.category')
            ->findOrFail($id);
        $categories = Category::all();
        return Inertia::render('Admin/Course/Show', [
            "course" => $course,
            "categories" => $categories
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
        $course = Course::with('user')->with('course_categories.category')->findOrFail($id);
        $categories = Category::all();
        $tutors = User::where('role', 'tutor')->get();
        return Inertia::render('Admin/Course/Edit', [
            "course" => $course,
            "tutors" => $tutors,
            "categories" => $categories,
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
            'name' => ['required', 'string', Rule::unique('courses')->ignore($id)],
            'description' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'status' => ['required', 'string'],
            'expire_date' => ['required', 'date'],
            'hours_left' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
            'course_img' => ['nullable', 'image'],
        ])->validate();

        $course = Course::findOrFail($id);

        if ($request->file('course_img') != null) {
            $path = Course::createCourseImg($request["course_img"]);
            $request->merge([
                'course_img' => $path
            ]);
            $course->update($request->all());
        } else {
            $course->update($request->except('course_img'));
        }

        Course::updateCourseCategories($request["selected_categories"], $course);

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
        Course::findOrFail($id)->delete();

        return redirect()->back();
    }
}
