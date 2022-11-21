@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center g-5">
        <div class="col-md-2">
            @include('menu/sidemenu')
        </div>
        <div class="col-md-10">

            <div class="row">
                <div class="col-md-4">
                    <h1>{{ __('Taken') }}</h1>
                </div>
                <div class="col-md-4">
                    <form class="d-flex" role="search" method="GET" action="{{ route('admin.orders.search') }}">
                        <input class="form-control me-2" type="search" placeholder="Zoeken" aria-label="Search" name="search">
                        <button class="btn btn-dark" type="submit">Zoeken</button>
                    </form>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('admin.tasks.create') }}" class="btn btn-dark">Taak aanmaken</a>
                </div>

            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Taak</th>
                                <th>Startdatum</th>

                                <th>Bekijken</th>
                                <th scope="col">Verwijderen</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->task }}</td>
                                <td>{{ date('d-m-Y', strtotime($task->startDate)) }}</td>

                                <td><a href="{{ route('admin.tasks.view', $task) }}" class="text-decoration-none">Bekijken</a></td>


                                <td><a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#task{{ $task->id }}">Verwijderen</a></td>




                                <div class="modal fade" id="task{{ $task->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Weet je zeker dat je deze taak wilt verwijderen?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">

                                                    <div class="col text-end">
                                                        <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Verwijderen</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>




                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection