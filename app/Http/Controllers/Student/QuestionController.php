<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    function __construct(Request $request)
    {
        // dd(Auth::id());
        // if ($request->route() != null) {
        //     $course_id = $request->route()->parameter('course');
        //     $this->course = Course::with(['enrollments' => function ($query) use ($course_id) {
        //         $query->where('course_id', $course_id)->where('user_id', '=', Auth::id());
        //     }])->findOrFail($course_id);
        //     $this->enrollment = $this->course->enrollments->first();
        // }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, $course_id, $lesson_id)
    {
        $enrollment = Enrollment::where('course_id', $course_id)->where('user_id', Auth::id())->first();

        Validator::make($request->all(), [
            'description' => ['required'],
        ])->validate();


        $request->merge([
            'create_date' => date("Y-m-d"),
            'lesson_id' => $lesson_id,
            'enrollment_id' => $enrollment->id,
        ]);


        Question::create($request->all());

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
        //
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
