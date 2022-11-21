@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center g-5">
        <div class="col-md-2">
            @include('menu/sidemenu')
        </div>

        <div class="col-md-10">
            @if (session('statusCreate'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('statusCreate') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('statusDelete'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('statusDelete') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('statusUpdate'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('statusUpdate') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="row">
                <div class="col-md-4">
                    <h1>{{ __('Alle projecten') }}</h1>
                </div>
                <div class="col-md-4">
                    <form class="d-flex" role="search" method="GET" action="{{ route('admin.projects.search') }}">
                        <input class="form-control me-2" type="search" placeholder="Zoeken" aria-label="Search" name="search">
                        <button class="btn btn-outline-dark" type="submit">Zoeken</button>
                    </form>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('admin.projects.create') }}" class="btn btn-outline-dark">Project aanmaken</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Artikel</th>
                                <th scope="col">Publicatiedatum</th>
                                <th scope="col">Bekijken</th>


                                <th scope="col">Verwijderen</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->title }}</td>
                                <td>{{ date('d-m-Y', strtotime($project->StartDate)) }}</td>
                                <td><a href="{{ route('admin.projects.show', $project) }}" class="text-decoration-none">Bekijken</a></td>
                                <td><a href="" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#article{{ $project->id }}">Verwijderen</a></td>




                                <div class="modal fade" id="article{{ $project->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Weet je zeker dat je {{ $project->title }} wilt verwijderen?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">

                                                    <div class="col text-end">
                                                        <form action="{{ route('admin.projects.destroy',  $project) }}" method="POST" class="inline">
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
                    <div class="card align-items-center border border-0 mt-3">
                        {{ $projects->links() }}
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection