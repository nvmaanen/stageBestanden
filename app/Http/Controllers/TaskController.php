<?php

namespace App\Http\Controllers;


use App\Models\ProjectUser;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // public function view(User $user, Project $project)
    // {

    //     $users = User::all();
    //     return view('createTask', compact('project', 'users'));
    // }

    public function view(Task $tasks)
    {
        $tasks = Task::all();

        return view('admin.tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('admin.tasks.create');
    }
    public function viewTask(Task $task)
    {
        $users = User::all();

        return view('admin.tasks.view', compact('task', 'users'));
    }


    public function storeUser(Request $request)
    {
        $projectUser = new UserTask();
        $projectUser->user_id = $request->user_id;
        $projectUser->project_id = $request->project->id;
        $projectUser->save();

        return view('admin.tasks.view', compact('task', 'users'));
    }



    public function store(Request $request)
    {
        // dd($project);
        $task = new Task;
        $task->task = $request->task;
        $task->description = $request->description;
        // $task->user_id = $request->user;
        // $task->project_id = $project->id;
        $task->startDate = $request->startDate;
        $task->endDate = $request->endDate;
        $task->completed = false;


        $task->save();

        return redirect()->route('admin.tasks.index');
    }


    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('admin.tasks.index');
    }


    public function edit(Task $task)
    {
        return view('admin.tasks.edit', compact('task'));
    }

    public function update(Task $task, Request $request)
    {
        $task->task = $request->task;
        $task->description = $request->description;
        $task->startDate = $request->startDate;
        $task->endDate = $request->endDate;
        $task->completed = false;




        $task->save();
        return redirect()->route('admin.tasks.view', $task);
    }





    public function viewTasks(Request $request)
    {
        $project = ProjectUser::where('user_id', $request->user()->id)->orderBy('created_at', 'DESC')->paginate(10);;
        $tasks = Task::where('user_id', $request->user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('userTasks', compact('tasks', 'project'));
    }



    public function approve(Task $task)
    {
        $task->completed = true;
        $task->save();
        return redirect()->route('userTasks');
    }

    public function unapprove(Task $task)
    {

        $task->completed = false;
        $task->save();
        return redirect()->route('userTasks');
    }
}
