<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function updateEducation(Request $request, $id)
    {
        $education = Education::findOrFail($id);
        $education->update($request->all());

        return $request->wantsJson()
            ? new JsonResponse('', 200)
            : back()->with('status', 'profile-education-updated');
    }

    public function createEducation(Request $request)
    {
        $request->merge([
            'user_id' => Auth::id()
        ]);

        Education::create($request->all());
    }
}
