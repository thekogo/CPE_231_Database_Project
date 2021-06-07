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
        $questionCourse = DB::select(
            DB::raw("select c.id, count(c.id) AS count_id from questions q
            JOIN enrollments e ON q.enrollment_id = e.id
            JOIN courses c ON e.course_id = c.id
            GROUP BY c.id
            ")
        );

        // // 2
        // $enrollmentCourseCurrentYear = DB::table('enrollments')
        //     ->whereYear('enroll_date', date("Y"))
        //     ->select('course_id', DB::raw('count(*) as total'))
        //     ->groupBy('course_id')
        //     ->get();

        // // 3
        // $reserveGroupByMonthYear = DB::table('reserves')
        //     ->select(
        //         DB::raw('count(id) as `total_reserves`'),
        //         DB::raw('YEAR(start_time) year')
        //     )
        //     ->whereYear('start_time', '>=', date("Y") - 5)
        //     ->whereYear('start_time', '<=', date("Y"))
        //     ->groupby('year')
        //     ->get();

        // // dd($reserveGroupByMonthYear);

        // //4

        // // 5
        // $totalPay = DB::select(DB::raw("select SUM(courses.price) as total, courses.id
        // from `enrollments`
        // join courses on enrollments.course_id = courses.id
        // where enrollments.payment_status = 'success'
        // group by enrollments.course_id"));
        // // dd($totalPay);

        // // 6
        // $totalRefund = DB::select(DB::raw("select count(courses.price) as total, courses.id
        // from `enrollments`
        // join courses on enrollments.course_id = courses.id and enrollments.payment_status = 'refund'
        // group by enrollments.course_id"));

        // // 7

        // // 8
        // $totalReview = DB::select(DB::raw("select courses.id, AVG(reviews.rating) as avg_rating
        // from `reviews`
        // join enrollments on enrollments.id = reviews.enrollment_id
        // join courses on enrollments.course_id = courses.id
        // group by courses.id"));



        // // 9
        // $top5Enrollment = DB::select(DB::raw("select count(enrollments.course_id)/count(enrollments.id) * 100 as total, enrollments.course_id
        // from `enrollments`
        // group by enrollments.course_id
        // order by total DESC
        // LIMIT 5"));

        // dd($enrollmentCourseCurrentYear);
        return Inertia::render('Admin/Analytic/Home', [
            'questionCourse' => $questionCourse
        ]);
    }
}
