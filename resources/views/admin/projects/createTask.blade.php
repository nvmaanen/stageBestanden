@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center g-5">
        <div class="col-md-2">
            @include('menu/sidemenu')
        </div>

        <div class="col-md-10">
            <div class="row">

                <div class="col">
                    <h1>{{ $project->title }}</h1>
                </div>

                <div class="col text-end">
                    <div class="dropdown-center">
                        <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Opties
                        </button>
                        <ul class="dropdown-menu">

                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#user{{ $project->id }}">Gebruikers toevoegen</a></li>
                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#task{{ $project->id }}">Taak toevoegen</a></li>

                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#project{{ $project->id }}">Project verwijderen</a></li>
                        </ul>
                    </div>
                    <div class="modal fade" id="user{{ $project->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Wie zou je willen toevoegen?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.projects.storeUser', $project->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <select class="form-select" name="user_id" aria-label="Default select example">

                                            @foreach($users as $user)

                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="col-md mt-3 text-end">
                                            <button type="submit" class="btn btn-dark">Toevoegen</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>




                    <div class="modal fade" id="task{{ $project->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Welke taak zou je willen toevoegen?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.projects.storeTask', $project->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <select class="form-select" name="task_id" aria-label="Default select example">

                                            @foreach($tasks as $task)

                                            <option value="{{ $task->id }}">{{ $task->task }}</option>
                                            @endforeach
                                        </select>
                                        <div class="col-md mt-3 text-end">
                                            <button type="submit" class="btn btn-dark">Toevoegen</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>




                </div>

            </div>

            <div class="card">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a href="{{ route('admin.projects.show', $project) }}" class="nav-link rounded-0" type="button" aria-selected="false">Beschrijving</a>
                        <a href="{{ route('admin.projects.show.edit', $project) }}" class="nav-link" type="button" aria-selected="false">Bewerken</a>
                        <a href="{{ route('admin.projects.users', $project) }}" class="nav-link" type="button" aria-selected="false">Gebruikers</a>
                        <a href="{{ route('admin.projects.tasks', $project) }}" class="nav-link" type="button" aria-selected="false">Taken</a>
                        <a href="{{ route('admin.projects.tasks', $project) }}" class="nav-link active" type="button" aria-selected="false">Taak toevoegen</a>

                    </div>
                </nav>

                <div class="card-body">

                    <form class="row g-3" action="{{ route('admin.projects.storeNewTask', $project) }}" method="POST" enctype="multipart/form-data">
                        @csrf


                        <div class="col-md-6">
                            <label for="task" class="form-label">Bedenk een titel</label>
                            <input name="task" type="text" class="form-control" id="task" placeholder="Koop een auto, krijg een gratis pizza" value="" required>
                        </div>



                        <div class="col-12 mb-3">
                            <label for="description" class="form-label">Schrijf een beschrijving</label>
                            <textarea class="form-control" name="description" id="description" rows="5" placeholder="Bij je lokale autodealer krijg je nu..." value=""></textarea>
                        </div>



                        <div class="row">
                            <div class="col-6">
                                <label for="startDate">Start datum</label>
                                <input type="date" id="startDate" name="startDate" class="form-control" value="" required>
                            </div>

                            <div class="col-6">
                                <label for="endDate">Deadline</label>
                                <input type="date" id="endDate" name="endDate" class="form-control" value="" required>
                            </div>
                        </div>



                        <div class="col-12 text-end">
                            <a href="" class="text-decoration-none">Annuleren</a>
                            <button type="submit" class="btn btn-dark ms-2">Opslaan</button>
                        </div>



                    </form>
                </div>




            </div>

        </div>

    </div>
</div>
@endsection