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
                    <h1>{{ __('Gebruiker aanmaken') }}</h1>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.users.store') }}" method="post">
                        @csrf





                        <label for="name" class="form-label">{{ __('Gebruikersnaam') }}</label>


                        <input id="name" type="text" class="form-control mb-3 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror




                        <label for="email" class="form-label">{{ __('E-mail adres') }}</label>


                        <input id="email" type="email" class="form-control mb-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror




                        <label for="password" class="form-label">{{ __('Wachtwoord') }}</label>


                        <input id="password" type="password" class="form-control mb-3 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror



                        <label for="password-confirm" class="form-label">{{ __('Herhaal wachtwoord') }}</label>
                        <input id="password-confirm" type="password" class="form-control mb-3" name="password_confirmation" required autocomplete="new-password">


                        <label for="role_id" class="form-label">Kies een rol uit</label>
                        <select class="form-select" id="role_id" name="role_id">

                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach

                        </select>



                        <div class="col text-end mt-3">
                            <button type="submit" class="btn btn-outline-dark">
                                {{ __('Opslaan') }}
                            </button>
                        </div>


                    </form>

                </div>
            </div>

        </div>




    </div>
</div>

@endsection