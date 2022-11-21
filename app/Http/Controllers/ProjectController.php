<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Role;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\ProjectTask;
use App\Models\Task;

class ProjectController extends Controller
{

    public function view(Project $project)
    {
        $this->authorize('create', Product::class);
        $projects = Project::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.projects.index', compact('projects', 'project'));
    }


    public function viewUsers(Project $project, User $users)
    {
        $users = User::all();
        return view('admin.projects.users', compact('project', 'users'));
    }
    public function viewTasks(Project $project, User $users)
    {
        $users = User::all();
        return view('admin.projects.tasks', compact('project', 'users'));
    }
    public function create()
    {
        $this->authorize('create', Product::class);
        return view('admin.projects.create');
    }
    public function createTask(Project $project)
    {
        $this->authorize('create', Product::class);
        $users = User::all();
        $tasks = Task::all();
        return view('admin.projects.createTask', compact('project', 'users', 'tasks'));
    }
    public function edit(Project $project)
    {
        $this->authorize('create', Product::class);
        return view('admin.projects.edit')->with('project', $project);
    }
    public function show(Project $project, Task $tasks)
    {
        $this->authorize('create', Product::class);
        $tasks = Task::all();
        $users = User::all();
        return view('admin.projects.show', compact('project', 'tasks', 'users'));
    }
    public function showEdit(Project $project)
    {
        $this->authorize('create', Product::class);
        return view('admin.projects.showEdit')->with('project', $project);
    }

    public function showUpdate(Project $project, Request $request)
    {

        $this->authorize('create', Product::class);
        $project->title = $request->title;
        $project->intro = $request->intro;
        $project->description = $request->description;
        $project->StartDate = $request->StartDate;
        $project->EndDate = $request->EndDate;

        if ($request->image) {
            $imageName = time() . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $project->image = $imageName;
        }

        $project->save();


        return redirect()->route('admin.projects.show', $project)->with('statusUpdate', __('Het project is aangepast!'));
    }


    public function store(Request $request)
    {
        $this->authorize('create', Product::class);
        $project = new Project;
        $project->title = $request->title;
        $project->intro = $request->intro;
        $project->description = $request->description;
        $project->StartDate = $request->StartDate;
        $project->EndDate = $request->EndDate;
        if ($request->image) {
            $imageName = time() . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $project->image = $imageName;
        }
        $project->save();
        return redirect(route('admin.projects.index'))->with('statusCreate', __('Het project is toegevoegd!'));
    }
    public function update(Project $project, Request $request)
    {

        $this->authorize('create', Product::class);
        $project->title = $request->title;
        $project->intro = $request->intro;
        $project->description = $request->description;
        $project->StartDate = $request->StartDate;
        $project->EndDate = $request->EndDate;

        if ($request->image) {
            $imageName = time() . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $project->image = $imageName;
        }

        $project->save();


        return redirect()->route('admin.projects.index')->with('statusUpdate', __('Het project is aangepast!'));
    }


    public function storeUser(Request $request, Project $project)
    {
        $projectUser = new ProjectUser();

        $projectUser->user_id = $request->user_id;
        $projectUser->project_id = $request->project->id;
        $projectUser->role_id = $request->user()->role_id;

        $projectUser->save();

        return redirect()->route('admin.projects.show', compact('project'));
    }

    public function storeTask(Request $request, Project $project)
    {
        $projectTask = new ProjectTask;
        $projectTask->task_id = $request->task_id;
        $projectTask->project_id = $request->project->id;
        $projectTask->save();

        return redirect()->route('admin.projects.show', compact('project'));
    }
    public function storeNewTask(Request $request, Project $project)
    {
        $task = new Task;
        $task->task = $request->task;
        $task->description = $request->description;
        // $task->user_id = $request->user;
        // $task->project_id = $project->id;
        $task->startDate = $request->startDate;
        $task->endDate = $request->endDate;
        $task->completed = false;


        $task->save();


        $projectTask = new ProjectTask;
        $projectTask->task_id = $task->id;
        $projectTask->project_id = $request->project->id;
        $projectTask->save();

        return redirect()->route('admin.projects.show', compact('project'));
    }





    public function destroy(Project $project)
    {
        $this->authorize('create', Product::class);
        unlink(public_path('/images/' . $project->image));

        $project->delete();

        return redirect()->route('admin.projects.index')->with('statusDelete', 'Het project is verwijderd!');
    }
}
