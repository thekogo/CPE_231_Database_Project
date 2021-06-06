<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class LessonController extends Controller
{

    function __construct(Request $request)
    {
        if ($request->route() != null) {
            $course_id = $request->route()->parameter('course');
            $this->course = Course::findOrFail($course_id);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::where('course_id', $this->course->id)->orderBy('order')->get();
        return Inertia::render('Admin/Lesson/Home', [
            'course' => $this->course,
            'lessons' => $lessons,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lessons = Lesson::where('course_id', $this->course->id)->get();
        return Inertia::render('Admin/Lesson/Create', [
            "course" => $this->course,
            "lessons" => $lessons,
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
        $lessons = Lesson::where('course_id', $this->course->id)->count();
        Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'order' => ['required', 'integer', "max:$lessons"],
        ])->validate();
        if ($request->order != $lessons) {
            Lesson::reOrder($this->course->id, $request->order);
        }
        Lesson::create($request->merge([
            'course_id' => $this->course->id
        ])->all());

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($course_id, $id)
    {
        $lesson = Lesson::with('questions')->with('questions.answers')->findOrFail($id);
        return Inertia::render('Admin/Lesson/Show', [
            "lesson" => $lesson,
            "course" => $this->course,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($course_id, $id)
    {
        $lesson = Lesson::findOrFail($id);
        $lessons = Lesson::where('course_id', $this->course->id)->orderBy('order')->get();
        return Inertia::render('Admin/Lesson/Edit', [
            "course" => $this->course,
            "lesson" => $lesson,
            "lessons" => $lessons,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $course_id, $id)
    {
        $lessons = Lesson::where('course_id', $this->course->id)->count();
        Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'order' => ['required', 'integer', "max:$lessons"],
        ])->validate();

        if ($request->order != $lessons) {
            Lesson::reOrder($this->course->id, $request->order);
        }

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
    public function destroy($course_id, $id)
    {
        $lesson = Lesson::findOrFail($id);
        $order = $lesson->order;
        $lesson->delete();
        Lesson::reOrder($this->course->id, $order, 'delete');

        return redirect()->back();
    }
}
