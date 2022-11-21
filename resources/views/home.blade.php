@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center g-5">
        @if(Auth::user()->role_id==1)
        <div class="col-md-2">
            @include('menu/sidemenu')
        </div>
        @else

        <div class="col-md-2">
            @include('menu/userSideMenu')
        </div>
        @endif
        <div class="col-md-10">
            <h1>{{ __('Overzicht') }}</h1>
            <div class="card">


                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('Je bent ingelogd!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection