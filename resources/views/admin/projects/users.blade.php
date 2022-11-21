@extends('layouts.app')
@section('content')

<div class="container mt-3">
    <div class="row justify-content-center g-5">
        <div class="col-md-2">
            @include('menu/sidemenu')
        </div>

        <div class="col-md-10">
            <div class="row">
                <div class="col-md-8">
                    <h1>{{ $project->title }}</h1>
                </div>
                <div class="col-md-4 text-end">
                    <div class="dropdown-center">
                        <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Opties
                        </button>
                        <ul class="dropdown-menu">

                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#project{{ $project->id}}">Medewerker toevoegen</a></li>



                        </ul>
                    </div>



                    <div class="modal fade" id="project{{ $project->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                </div>
            </div>

            <div class="card">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a href="{{ route('admin.projects.show', $project) }}" class="nav-link rounded-0" type="button" aria-selected="false">Beschrijving</a>
                        <a href="{{ route('admin.projects.show.edit', $project) }}" class="nav-link" type="button" aria-selected="false">Bewerken</a>
                        <a href="" class="nav-link active" type="button" aria-selected="false">Gebruikers</a>
                        <a href="{{ route('admin.projects.tasks', $project) }}" class="nav-link" type="button" aria-selected="false">Taken</a>
                    </div>
                </nav>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Gebruiker</th>
                                <th>E-mail</th>





                            </tr>
                        </thead>
                        <tbody>
                            @foreach($project->users as $user)
                            <tr>
                                <td>{{ $user->user->name }}</td>
                                <td>{{ $user->user->email }}</td>





                            </tr>
                            @endforeach
                        </tbody>

                    </table>








                </div>
            </div>
        </div>


    </div>




</div>
</div>

@endsection