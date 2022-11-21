@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center g-5">
        <div class="col-md-2">
            @include('menu/userSideMenu')
        </div>
        <div class="col-md-10">

            <div class="row">
                <div class="col-md-4">
                    <h1>{{ __('Taken') }}</h1>
                </div>
                <div class="col-md-4">
                    <form class="d-flex" role="search" method="GET" action="">
                        <input class="form-control me-2" type="search" placeholder="Zoeken" aria-label="Search" name="search">
                        <button class="btn btn-dark" type="submit">Zoeken</button>
                    </form>
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
                            <!-- foreach -->
                            <tr>
                                <td></td>


                            </tr>
                            <!-- endforeach -->
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection