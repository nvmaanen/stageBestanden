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
                    <h1>{{ $company->name }}</h1>
                </div>
                <div class="col-md-4 text-end">
                    <div class="dropdown-center">
                        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Opties
                        </button>
                        <ul class="dropdown-menu">

                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#company{{ $company->id }}">Medewerker toevoegen</a></li>
                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#project{{ $company->id }}">Project toevoegen</a></li>


                        </ul>
                    </div>



                    <div class="modal fade" id="company{{ $company->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Wie zou je willen toevoegen?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{  route('admin.companies.addEmployee', $company) }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <select class="form-select" name="employee_id" aria-label="Default select example">

                                            @foreach($employees as $employee)

                                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
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

                    <div class="modal fade" id="project{{ $company->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Welk project zou je willen toevoegen??</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.companies.storeProject', $company) }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <select class="form-select" name="project_id" aria-label="Default select example">

                                            @foreach($projects as $project)

                                            <option value="{{ $project->id }}">{{ $project->title }}</option>
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
                        <a class="nav-link" href="{{ route('admin.companies.projects', $company) }}">Projecten</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.companies.employees', $company) }}">Medewerkers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.companies.createEmployee', $company) }}">Medewerker aanmaken</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.companies.edit', $company) }}">Gegevens bewerken</a>
                    </li>

                </ul>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            {{$company->name}}


                        </div>
                    </div>



                </div>
            </div>
        </div>


    </div>




</div>
</div>

@endsection