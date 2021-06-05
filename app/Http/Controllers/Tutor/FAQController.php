<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\FAQ;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class FAQController extends Controller
{

    function __construct(Request $request)
    {
        if ($request->route() != null) {
            $course_id = $request->route()->parameter('course');
            $lesson_id = $request->route()->parameter('lesson');
            $this->course = Course::findOrFail($course_id);
            $this->lesson = Lesson::findOrFail($lesson_id);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = FAQ::where('lesson_id', $this->lesson->id)->get();
        return Inertia::render('Tutor/FAQ/Home', [
            "course" => $this->course,
            "lesson" => $this->lesson,
            "faqs" => $faqs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Tutor/FAQ/Create', [
            "course" => $this->course,
            "lesson" => $this->lesson,
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
            'question' => ['required', 'string'],
            'answer' => ['required', 'string'],
        ])->validate();

        $request->merge([
            'create_date' => date("Y-m-d"),
        ]);

        FAQ::create($request->merge([
            'lesson_id' => $this->lesson->id
        ])->all());
        
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
    public function edit($course_id, $lesson_id, $id)
    {
        $faq = FAQ::findOrFail($id);
        return Inertia::render('Tutor/FAQ/Edit', [
            "course" => $this->course,
            "lesson" => $this->lesson,
            "faq" => $faq
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
            'question' => ['required', 'string'],
            'answer' => ['required', 'string'],
        ])->validate();

        $faq = FAQ::findOrFail($id);
        $faq->update($request->all());

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
        FAQ::findOrFail($id)->delete();

        return redirect()->back();
    }
}
