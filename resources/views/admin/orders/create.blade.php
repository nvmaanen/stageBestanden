@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center g-5">

        <div class="col-md-10">
            <div class="row">
                <div class="col-md-8">
                    <h1>{{ __('Bestelling aanmaken') }}</h1>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form class="row g-3" action="{{ route('admin.orders.store') }}" method="POST">
                        @csrf

                        <div class="col-md-12">
                            <label for="name" class="form-label">Naam</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="John Doe" value="" required>
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">E-mail</label>
                            <input name="email" type="text" class="form-control" id="email" placeholder="pindakoekje@gmail.com" value="" required>
                        </div>

                        <div class="col-md-12">
                            <label for="address" class="form-label">Adres</label>
                            <input name="address" type="text" class="form-control" id="address" placeholder="Grote Markt 12" value="" required>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="zipcode" class="form-label">Postcode</label>
                                <input name="zipcode" type="text" class="form-control" id="zipcode" placeholder="9273KV" value="" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="residence" class="form-label">Woonplaats</label>
                                <input name="residence" type="text" class="form-control" id="residence" placeholder="Groningen" value="" required>
                            </div>
                        </div>
                        <hr>

                        <label for="product_id">Voeg een product toe</label>
                        <select class="form-select mb-3" id="product_id" aria-label="Default select example">
                            @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>








                        <div class="col-12 text-end">
                            <a href="{{ route('admin.orders.index') }}" class="text-decoration-none">Annuleren</a>
                            <button type="submit" class="btn btn-dark ms-2">Volgende stap</button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
        <!-- <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Overzicht</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <p>Totale prijs</p>
                        </div>
                        <div class="col">


                            <p>€{{ $product->price }}</p>
                        </div>
                    </div>



                </div>
            </div>

        </div> -->


    </div>
</div>
@endsection