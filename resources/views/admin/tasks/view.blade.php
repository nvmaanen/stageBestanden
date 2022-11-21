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
                    <h1>{{ $task->task }}</h1>
                </div>
                <div class="col-md-4 text-end">
                    <div class="dropdown-center">
                        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Opties
                        </button>
                        <ul class="dropdown-menu">

                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#user{{ $task->id }}">Gebruiker toevoegen</a></li>



                        </ul>
                    </div>




                    <div class="modal fade" id="user{{ $task->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Wie zou je willen toevoegen?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data">
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
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Overzicht</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.tasks.edit', $task) }}">Bewerken</a>
                    </li>

                </ul>
                <div class="card-body">
                    <div class="row">
                        <div class="col">


                        </div>
                    </div>






                </div>
            </div>

        </div>




    </div>
</div>

@endsection