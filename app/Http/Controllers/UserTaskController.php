<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\ProjectTask;
use App\Models\ProjectUser;

class UserTaskController extends Controller
{

    public function view(Request $request)
    {

        $tasks = ProjectTask::where('user_id', $request->user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('user.tasks.index', compact('tasks'));
    }
}
