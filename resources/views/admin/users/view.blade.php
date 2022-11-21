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
                    <h1>{{ $user->name }}'s gegevens</h1>
                </div>
            </div>

            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Overzicht</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users.edit', $user) }}">Gegevens</a>
                    </li>

                </ul>
                <div class="card-body">
                    <div class="row">
                        <div class="col">

                        </div>
                        <div class="col">
                            {{$user->name}}

                        </div>
                    </div>



                </div>
            </div>

        </div>




    </div>
</div>

@endsection