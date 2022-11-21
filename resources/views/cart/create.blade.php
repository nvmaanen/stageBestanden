@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center g-5">

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8">
                    <h1>{{ __('Gegevens') }}</h1>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    @if($customerData)
                    <form class="row g-3" action="{{ route('cart.order') }}" method="POST">
                        @csrf

                        <div class="col-md-12">
                            <label for="name" class="form-label">Naam</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="John Doe" value="{{ $customerData['name'] }}" required>
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">E-mail</label>
                            <input name="email" type="text" class="form-control" id="email" placeholder="pindakoekje@gmail.com" value="{{ $customerData['email'] }}" required>
                        </div>

                        <div class="col-md-12">
                            <label for="address" class="form-label">Adres</label>
                            <input name="address" type="text" class="form-control" id="address" placeholder="Grote Markt 12" value="{{ $customerData['address'] }}" required>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="zipcode" class="form-label">Postcode</label>
                                <input name="zipcode" type="text" class="form-control" id="zipcode" placeholder="9273KV" value="{{ $customerData['zipcode'] }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="residence" class="form-label">Woonplaats</label>
                                <input name="residence" type="text" class="form-control" id="residence" placeholder="Groningen" value="{{ $customerData['residence'] }}" required>
                            </div>
                        </div>








                        <div class="col-12 text-end">
                            <a href="{{ route('cart.index') }}" class="text-decoration-none">Winkelwagen wijzigen</a>
                            <button type="submit" class="btn btn-dark ms-2">Volgende stap</button>
                        </div>

                    </form>
                    @else
                    <form class="row g-3" action="{{ route('cart.order') }}" method="POST">
                        @csrf

                        <div class="col-md-12">
                            <label for="name" class="form-label">Naam</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="John Doe" required>
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">E-mail</label>
                            <input name="email" type="text" class="form-control" id="email" placeholder="pindakoekje@gmail.com" required>
                        </div>

                        <div class="col-md-12">
                            <label for="address" class="form-label">Adres</label>
                            <input name="address" type="text" class="form-control" id="address" placeholder="Grote Markt 12" required>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="zipcode" class="form-label">Postcode</label>
                                <input name="zipcode" type="text" class="form-control" id="zipcode" placeholder="9273KV" required>
                            </div>

                            <div class="col-md-6">
                                <label for="residence" class="form-label">Woonplaats</label>
                                <input name="residence" type="text" class="form-control" id="residence" placeholder="Groningen" required>
                            </div>
                        </div>








                        <div class="col-12 text-end">
                            <a href="{{ route('cart.index') }}" class="text-decoration-none">Winkelwagen wijzigen</a>
                            <button type="submit" class="btn btn-dark ms-2">Volgende stap</button>
                        </div>

                    </form>

                    @endif



                </div>

            </div>
        </div>



    </div>
</div>
@endsection