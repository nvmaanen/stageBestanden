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
                    <h1>{{ __('Bedrijf aanmaken') }}</h1>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.companies.store') }}" method="post">
                        @csrf

                        <div class="col-md-12 mb-2">
                            <label for="name" class="form-label">Bedrijfsnaam</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="Custom Website" value="" required>
                        </div>

                        <div class="col-md-12 mb-2">
                            <label for="address" class="form-label">Adres</label>
                            <input name="address" type="text" class="form-control" id="address" placeholder="Grote Markt 12" value="" required>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="zipcode" class="form-label">Postcode</label>
                            <input name="zipcode" type="text" class="form-control" id="zipcode" placeholder="Grote Markt 12" value="" required>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="telephone" class="form-label">Telefoonnummer</label>
                            <input name="telephone" type="text" class="form-control" id="telephone" placeholder="Grote Markt 12" value="" required>
                        </div>

                        <div class="col-md-12 mb-2">
                            <label for="email" class="form-label">E-mail</label>
                            <input name="email" type="text" class="form-control" id="email" placeholder="pindakoekje@gmail.com" value="" required>
                        </div>






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