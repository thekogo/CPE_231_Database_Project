<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
        $courses = Course::with('user')->where('user_id', Auth::id())->get();
        return Inertia::render('Tutor/Course/Home', [
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
        $tutor = Auth::user();
        $categories = Category::all();
        return Inertia::render('Tutor/Course/Create', [
            "tutor" => $tutor,
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
            'id' => ['required', 'string', 'unique:courses'],
            'name' => ['required', 'string', 'unique:courses'],
            'description' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'expire_date' => ['required', 'date'],
            'hours_left' => ['required', 'integer'],
            'course_img' => ['image', 'nullable'],
        ])->validate();

        $path = null;
        if ($request->file('course_img') != null) {
            $path = Course::createCourseImg($request["course_img"]);
        }

        $request->merge([
            'create_date' => date("Y-m-d"),
            'course_img' => $path,
            'user_id' => Auth::id(),
            'status' => 'รอการอนุมัติ'
        ]);

        $input = $request->all();
        $input["course_img"] = $path;

        $course = Course::create($input);

        $course->id = $request->id;

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
        $course = Course::with('user')->with('course_categories.category')->findOrFail($id);
        $categories = Category::all();
        return Inertia::render('Tutor/Course/Show', [
            "course" => $course,
            "categories" => $categories,
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
        $tutor = Auth::user();
        return Inertia::render('Tutor/Course/Edit', [
            "course" => $course,
            "tutor" => $tutor,
            "categories" => $categories
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
            'id' => ['required', 'string', Rule::unique('courses')->ignore($id)],
            'name' => ['required', 'string', Rule::unique('courses')->ignore($id)],
            'description' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'expire_date' => ['required', 'date'],
            'hours_left' => ['required', 'integer'],
            'course_img' => ['image', 'nullable'],
        ])->validate();

        $course = Course::findOrFail($id);
        $input = $request->all();
        if ($request->file('course_img') != null) {
            $path = Course::createCourseImg($request["course_img"]);
            $input['course_img'] = $path;
            $course->update($input);
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
