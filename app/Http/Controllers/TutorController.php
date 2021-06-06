<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TutorController extends Controller
{
    public function viewAllTutors()
    {
        $tutors = User::where('role', 'tutor')->get();
        return Inertia::render('Home/Tutor/viewAllTutors', [
            'tutors' => $tutors
        ]);
    }

    public function viewDetailTutor($tutor_id)
    {
        $tutor = User::where('role', 'tutor')->findOrFail($tutor_id);
        return Inertia::render('Home/Tutor/ViewDetailTutor', [
            'tutor' => $tutor
        ]);
    }
}
