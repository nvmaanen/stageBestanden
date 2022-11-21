@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center g-5">
        <div class="col-md-2">
            @include('menu/sidemenu')
        </div>
        <div class="col-md-10">
            <h1>Bestelling wijzigen</h1>

            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.orders.view', $order) }}">Overzicht</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('admin.orders.edit', $order) }}">Gegevens</a>
                    </li>

                </ul>
                <div class="card-body">
                    <form class="row g-3" action="{{ route('admin.orders.update', $order) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')


                        <div class="col-md-6">
                            <label for="name" class="form-label">Wijzig de naam</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="John Doe" value="{{ $order->name }}" required>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="description" class="form-label">Wijzig het mailadres</label>
                            <input name="email" type="text" class="form-control" id="email" placeholder="John Doe" value="{{ $order->email }}" required>
                        </div>


                        <div class="mb-3">
                            <label for="address" class="form-label">Wijzig het adres</label>
                            <input class="form-control" type="text" id="address" name="address" value="{{ $order->address }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="zipcode" class="form-label">Wijzig de postcode</label>
                            <input class="form-control" type="text" id="zipcode" name="zipcode" value="{{ $order->zipcode }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="residence" class="form-label">Wijzig de woonplaats</label>
                            <input class="form-control" type="text" id="residence" name="residence" value="{{ $order->residence }}" required>
                        </div>

                        <!-- <table class="table">
                            <thead>
                                <th>Product</th>
                                <th>Prijs</th>
                                <th>Hoeveelheid</th>
                            </thead>
                            <tbody>
                                @foreach($productOrder as $product)
                                <tr>
                                    <td>{{ $product->product->name}}</td>
                                    <td>€{{ $product->product->price }}</td>
                                    <td>{{ $product->quantity }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table> -->




                        <div class="col-12 text-end">
                            <a href="{{ route('admin.orders.index') }}" class="text-decoration-none">Annuleren</a>
                            <button type="submit" class="btn btn-dark ms-2">Opslaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection