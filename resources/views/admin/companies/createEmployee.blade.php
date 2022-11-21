@extends('layouts.app')

@section('content')

<div class="container mt-3">
    <div class="row g-5">
        <div class="col-md-2">
            @include('menu/sidemenu')
        </div>




        <div class="col-md-10">
            <div class="row">
                <div class="col">
                    <h1>{{ $company->name }}</h1>
                </div>
                <div class="col text-end">
                    <div class="dropdown-center">
                        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Opties
                        </button>
                        <ul class="dropdown-menu">


                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal1{{ $company->id }}">Medewerker toevoegen</a></li>



                        </ul>



                    </div>


                    <div class="modal fade" id="modal1{{ $company->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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


                </div>







            </div>
            <div class="card">
                <nav>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.companies.view', $company) }}">Overzicht</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.companies.projects', $company) }}">Projecten</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.companies.employees', $company) }}">Medewerkers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('admin.companies.createEmployee', $company) }}">Medewerker aanmaken</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.companies.edit', $company) }}">Gegevens bewerken</a>
                        </li>

                    </ul>
                </nav>
                <div class="card-body">

                    <form class="row g-3" action="{{ route('admin.companies.storeEmployee', $company) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="col">
                            <label for="name" class="form-label">Naam Medewerker</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="Niels van Maanen" required>
                        </div>

                        <div class="mb-2">
                            <label for="address" class="form-label">Adres</label>
                            <input name="address" type="text" class="form-control" id="address" placeholder="Korreweg 29b" required>
                        </div>
                        <div class="mb-2">
                            <label for="zipcode" class="form-label">Postcode</label>
                            <input name="zipcode" type="text" class="form-control" id="zipcode" placeholder="9714 AB" required>
                        </div>
                        <div class="mb-2">
                            <label for="telephone" class="form-label">Telefoonnummer</label>
                            <input name="telephone" type="text" class="form-control" id="telephone" placeholder="06 38682824" required>
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label">email</label>
                            <input name="email" type="email" class="form-control" id="email" placeholder="nvmaanen@live.nl" required>
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