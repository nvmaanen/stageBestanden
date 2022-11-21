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

                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#project2{{ $project->id }}">Gebruikers toevoegen</a></li>

                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#project{{ $project->id }}">Project verwijderen</a></li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="card">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a href="{{ route('admin.projects.show', $project) }}" class="nav-link" type="button" aria-selected="false">Beschrijving</a>
                        <a href="#" class="nav-link active rounded-0" type="button" aria-selected="false">Bewerken</a>
                        <a href="{{ route('admin.projects.users', $project) }}" class="nav-link" type="button" aria-selected="false">Gebruikers</a>
                        <a href="{{ route('admin.projects.tasks', $project) }}" class="nav-link" type="button" aria-selected="false">Taken</a>
                    </div>
                </nav>

                <div class="card-body">
                    <form class="row g-3" action="{{ route('admin.projects.show.update', $project) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">
                            <label for="title" class="form-label">Bedenk een titel</label>
                            <input name="title" type="text" class="form-control" id="title" placeholder="Koop een auto, krijg een gratis pizza" value="{{ $project->title ?? '' }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="intro" class="form-label">Schrijf een inleiding</label>
                            <input name="intro" type="text" class="form-control" id="intro" placeholder="Koop een auto, krijg een gratis pizza" value="{{ $project->intro ?? '' }}" required>
                        </div>



                        <div class="col-12 mb-3">
                            <label for="description" class="form-label">Schrijf de content</label>
                            <textarea class="form-control" name="description" id="description" rows="5" placeholder="Bij je lokale autodealer krijg je nu..." value="{{ $project->description ?? '' }}">{{ $project->description ?? '' }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label for="StartDate">Publicatie datum</label>
                                <input type="date" id="StartDate" name="StartDate" class="form-control" value="{{ isset($project) ? date('d-m-Y', strtotime($project->StartDate)) : '' }}" required>
                            </div>

                            <div class="col-6">
                                <label for="EndDate">Verval datum</label>
                                <input type="date" id="EndDate" name="EndDate" class="form-control" value="{{ isset($project) ? date('d-m-Y', strtotime($project->EndDate)) : '' }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Kies een afbeelding</label>
                            <input class="form-control" type="file" id="image" name="image" value="{{ $project->image ?? '' }}" required>
                        </div>


                        <div class="col-12 text-end">
                            <a href="{{ route('admin.projects.index') }}" class="text-decoration-none">Annuleren</a>
                            <button type="submit" class="btn btn-dark ms-2">Opslaan</button>
                        </div>


                    </form>






                </div>




            </div>

        </div>

    </div>
</div>
@endsection