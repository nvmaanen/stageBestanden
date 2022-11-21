@extends('layouts.app')
@php
$total = 0;
$total_vat = 0;
$total_price_excl = 0;
$total_discount = 0;
@endphp
@section('content')
<div class="container mt-3">
    <div class="row justify-content-center g-5">

        <div class="col-md-8">
            @if (session('status'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('statusQuantity'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('statusQuantity') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('statusDelete'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('statusDelete') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="row">
                <div class="col-md-8">
                    <h1>{{ __('Winkelwagen') }}</h1>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    @if ($cartItems)
                    <table class="table table-hover">
                        @error('quantity')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <thead>
                            <tr>
                                <th>Naam</th>
                                <th>Aantal</th>
                                <th>Prijs per stuk</th>
                                <th>Korting prijs per stuk</th>
                                <th>Totaal</th>
                                <th>BTW</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $cartItem)
                            <tr>
                                <td>{{$cartItem['product']->name}}</td>
                                <td>
                                    <form action="{{ route('cart.update', $cartItem) }}" method="post">
                                        @csrf
                                        <input type="number" id="quantity" name="quantity" value="{{ $cartItem['quantity'] }}" onchange="this.form.submit()">
                                    </form>
                                </td>
                                <td>€{{ number_format($cartItem['product']->price, 2, ',', '.') }}</td>
                                @if($cartItem['product']->discount_price)
                                <td>€{{ number_format($cartItem['product']->discount_price, 2, ',', '.') }}</td>
                                <td>€{{ number_format($cartItem['product']->discount_price * $cartItem["quantity"], 2, ',', '.') }}</td>
                                @else
                                <td>-</td>
                                <td>€{{number_format($cartItem["product"]->price * $cartItem["quantity"], 2, ',', '.') }}</td>
                                @endif


                                <td>{{ $cartItem['product']->vat }}%</td>

                                <td><a href="{{ route('cart.delete', $cartItem) }}" class="text-decoration-none text-dark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                                        </svg></a></td>




                                @php
                                if ($cartItem['product']->discount_price) {
                                $total += $cartItem['product']->discount_price * $cartItem["quantity"] * ($cartItem["product"]->vat / 100) + $cartItem['product']->discount_price * $cartItem["quantity"];
                                $total_price_excl += $cartItem['product']->discount_price * $cartItem["quantity"];
                                $total_vat += $cartItem['product']->discount_price * $cartItem["quantity"] * ($cartItem["product"]->vat / 100);
                                $total_discount += ($cartItem["product"]->price * $cartItem["quantity"]) - ($cartItem['product']->discount_price * $cartItem["quantity"]);
                                } else {
                                $total += $cartItem["product"]->price * $cartItem["quantity"] * ($cartItem["product"]->vat / 100) + $cartItem["product"]->price * $cartItem["quantity"];
                                $total_price_excl += $cartItem["product"]->price * $cartItem["quantity"];
                                $total_vat += $cartItem["product"]->price * $cartItem["quantity"] * ($cartItem["product"]->vat / 100);
                                }

                                @endphp

                            </tr>
                            @endforeach


                        </tbody>

                    </table>
                    @else

                    <p>leeg</p>
                    @endif





                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Overzicht</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">

                            <p>Totale korting:</p>

                            <p>Subtotaal:</p>
                            <p>BTW:</p>
                            <p>Totale prijs</p>

                        </div>
                        <div class="col">

                            <p>€ -{{ number_format($total_discount, 2, ',', '.') }}</p>

                            <p>€{{ number_format($total_price_excl, 2, ',', '.') }}</p>
                            <p>€{{ number_format($total_vat, 2, ',', '.') }}</p>
                            <p>€{{number_format($total, 2, ',', '.')}}</p>
                        </div>
                    </div>
                    @if($cartItems)
                    <div class="d-grid">
                        <a href="{{ route('cart.details') }}" class="btn btn-dark">Verder naar bestellen</a>
                    </div>
                    @endif
                </div>
            </div>

        </div>






    </div>
</div>
@endsection