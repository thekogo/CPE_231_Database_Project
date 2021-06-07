<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AnalyticController extends Controller
{
    public function index()
    {
        // 1
        $questionCourse =

            // 2
            $enrollmentCourseCurrentYear = DB::table('enrollments')
            ->whereYear('enroll_date', date("Y"))
            ->select('course_id', DB::raw('count(*) as total'))
            ->groupBy('course_id')
            ->get();

        // 3
        // $reserveGroupByMonthYear = DB::table('reserves')
        // ->select(
        //     DB::raw('count(id) as `total_reserves`'),
        //     DB::raw("DATE_FORMAT(start_time, '%m-%Y') new_date"),
        //     DB::raw('YEAR(start_time) year, MONTH(start_time) month')
        // )
        // ->whereYear('start_time', '>=', date("Y") - 5)
        // ->whereYear('start_time', '<=', date("Y"))
        // ->groupby('year', 'month')
        // ->get();

        //4

        // 5
        $totalPay = Enrollment::whereYear('payment_date', '>=', date("Y") - 5)
            ->groupBy('course_id', '');

        // 6

        // 7

        // 8

        // 9
        // $top5Enrollment = Enrollment::

        // dd($enrollmentCourseCurrentYear);
        return Inertia::render('Admin/Analytic/Home');
    }
}
