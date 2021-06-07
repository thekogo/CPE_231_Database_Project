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
        $questionCourses = DB::select(
            DB::raw("select c.id, count(c.id) AS count_id from questions q
            JOIN enrollments e ON q.enrollment_id = e.id
            JOIN courses c ON e.course_id = c.id
            GROUP BY c.id
            ")
        );

        // 2
        $enrollmentCourseCurrentYears = DB::table('enrollments')
            ->whereYear('enroll_date', date("Y"))
            ->select('course_id', DB::raw('count(*) as total'))
            ->groupBy('course_id')
            ->get();

        // 3

        $reserveGroupByYears = DB::table('reserves')
            ->select(
                DB::raw('count(id) as `total_reserves`'),
                DB::raw('YEAR(start_time) year')
            )
            ->whereYear('start_time', '>=', date("Y") - 5)
            ->whereYear('start_time', '<=', date("Y"))
            ->groupby('year')
            ->get();

        // dd($reserveGroupByYears);

        // //4

        // 5
        $totalCoursePays = DB::select(DB::raw("select SUM(courses.price) as total, courses.id
        from `enrollments`
        join courses on enrollments.course_id = courses.id
        where enrollments.payment_status = 'success'
        group by enrollments.course_id"));
        // dd($totalPay);

        // 6
        $totalRefunds = DB::select(DB::raw("select count(courses.price) as total, courses.id
        from `enrollments`
        join courses on enrollments.course_id = courses.id and enrollments.payment_status = 'refund'
        group by enrollments.course_id"));

        // // 7

        // 8
        $totalReviews = DB::select(DB::raw("select courses.id, AVG(reviews.rating) as avg_rating
        from `reviews`
        join enrollments on enrollments.id = reviews.enrollment_id
        join courses on enrollments.course_id = courses.id
        group by courses.id"));



        // 9
        $top5EnrollmentPersents = DB::select(DB::raw("
        select count(enrollments.course_id)/(select count(*) from enrollments) * 100 as total, enrollments.course_id
        from `enrollments`
        group by enrollments.course_id
        order by total DESC
        LIMIT 5"));

        // 10
        $top5studentLearneds = DB::select(DB::raw(
            "select u.firstName, u.lastName, count(l.id) AS 'total_learned' FROM users u, enrollments e, lesson_histories l
            where e.user_id = u.id
            group by u.firstName, u.lastName
            order by count(l.id) DESC
            limit 5
            "
        ));

        $top5Enrollments = DB::select(DB::raw(
            "select u.id, u.firstName, u.lastName, count(e.course_id) as 'count' from users u, enrollments e
            where u.id = e.user_id
            group by u.id, u.firstName, u.lastName
            order by count(e.course_id) DESC
            limit 5
            "
        ));

        // dd($top5Enrollments);

        // dd($enrollmentCourseCurrentYear);
        return Inertia::render('Admin/Analytic/Home', [
            'questionCourses' => $questionCourses,
            'enrollmentCourseCurrentYears' => $enrollmentCourseCurrentYears,
            'reserveGroupByYears' => $reserveGroupByYears,
            'totalCoursePays' => $totalCoursePays,
            'totalRefunds' => $totalRefunds,
            'totalReviews' => $totalReviews,
            'top5studentLearneds' => $top5studentLearneds,
            'top5Enrollments' => $top5Enrollments,
            'top5EnrollmentPersents' => $top5EnrollmentPersents,
        ]);
    }
}
