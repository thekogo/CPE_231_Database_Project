<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ReserveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enrollments = Enrollment::where('user_id', Auth::id())->pluck('id')->toArray();
        $reserves = Reserve::whereIn('enrollment_id', $enrollments)->with('enrollment.course')->get();
        return Inertia::render('Student/Reserve/Home', [
            'reserves' => $reserves
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $enrollments = Enrollment::where('user_id', Auth::id())->with('course')->get();
        // dd($enrollments);
        return Inertia::render('Student/Reserve/Create', [
            'enrollments' => $enrollments
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
        $enrollment = Enrollment::where('user_id', Auth::id())->where('course_id', $request->course_id)->first();
        $request->merge([
            'status' => "รอการอนุมัติ",
            'enrollment_id' => $enrollment->id
        ]);
        Reserve::create($request->all());

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
        Reserve::findOrFail($id)->delete();

        return redirect()->back();
    }
}
