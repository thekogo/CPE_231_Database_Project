<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Models\Course;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;


class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::all();
        return Inertia::render('Admin/Lesson/Home', [
            "lessons" => $lessons
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();
        return Inertia::render('Admin/Lesson/Create', [
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
            'name' => ['required', 'string'],
            'order' => ['required', 'integer'],
            'vdo_url' => ['', ''],
            'desciption' => ['', ''],
            'course_id' => ['required', 'integer'],
        ])->validate();

        Lesson::create($request->all());

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
        $lesson = Lesson::findOrFail($id);
        return Inertia::render('Admin/Lesson/Show', [
            "lesson" => $lesson,
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
        $lesson = Lesson::findOrFail($id);
        $courses = Course::all();
        return Inertia::render('Admin/Lesson/Edit', [
            "lesson" => $lesson,
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
            'name' => ['required', 'string'],
            'order' => ['required', 'integer'],
            'vdo_url' => ['', ''],
            'desciption' => ['', ''],
            'course_id' => ['required', 'integer'],
        ])->validate();

        $lesson = Lesson::findOrFail($id);
        $lesson->update($request->all());
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
        Lesson::findOrFail($id)->delete();

        return redirect()->back();
    }
}
