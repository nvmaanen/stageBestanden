<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProjectUser;

class UserProjectController extends Controller
{

    public function view(Request $request)
    {

        $projects = ProjectUser::where('user_id', $request->user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('user.projects.index', compact('projects'));
    }
}
