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
        @if($cartItems)

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8">
                    <h1>{{ __('Overzicht') }}</h1>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('order.storeOrder') }}" method="POST">
                        @csrf

                        <h4>Gegevens</h4>
                        <div class="row">
                            <input type="hidden" name="name" id="name" value="{{ $customerData['name'] }}">
                            <div class="col">Naam: {{ $customerData['name'] }}</div>

                        </div>
                        <div class="row">
                            <input type="hidden" name="email" id="email" value="{{ $customerData['email'] }}">
                            <div class="col">Email: {{ $customerData['email'] }}</div>

                        </div>
                        <div class="row">
                            <input type="hidden" name="address" id="address" value="{{ $customerData['address'] }}">
                            <div class="col">Adres: {{ $customerData['address'] }}</div>

                        </div>
                        <div class="row">
                            <input type="hidden" name="zipcode" id="zipcode" value="{{ $customerData['zipcode'] }}">
                            <div class="col">Postcode: {{ $customerData['zipcode'] }}</div>

                        </div>
                        <div class="row mb-3">
                            <input type="hidden" name="residence" id="residence" value="{{ $customerData['residence'] }}">
                            <div class="col">Woonplaats: {{ $customerData['residence'] }}</div>

                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Naam</th>
                                    <th>Aantal</th>
                                    <th>Prijs per stuk</th>
                                    <th>Korting prijs per stuk</th>
                                    <th>Totaal</th>
                                    <th>BTW</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $cartItem)
                                <tr>
                                    <td>{{$cartItem['product']->name}}</td>
                                    <td>{{ $cartItem['quantity'] }}</td>
                                    <td>€{{ number_format($cartItem['product']->price, 2, ',', '.') }}</td>
                                    @if($cartItem['product']->discount_price)
                                    <td>€{{ number_format($cartItem['product']->discount_price, 2, ',', '.') }}</td>
                                    <td>€{{ number_format($cartItem['product']->discount_price * $cartItem["quantity"], 2, ',', '.') }}</td>
                                    @else
                                    <td>-</td>
                                    <td>€{{number_format($cartItem["product"]->price * $cartItem["quantity"], 2, ',', '.') }}</td>
                                    @endif
                                    <input type="hidden" name="product_id" id="product_id" value="{{ $cartItem['product']->id }}">
                                    <input type="hidden" name="price" id="price" value="{{ $cartItem['product']->price }}">
                                    <input type="hidden" name="vat" id="vat" value="{{ $cartItem['product']->vat }}">
                                    <input type="hidden" name="quantity" id="quantity" value="{{ $cartItem['quantity'] }}">
                                    <td>{{ $cartItem['product']->vat }}%</td>
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
                        <div class="col text-end">
                            @if($cartItem['product']->discount_price)
                            <p>Totale korting: € -{{ number_format($total_discount, 2, ',', '.') }}</p>
                            @endif
                            <p>Subtotaal: €{{ number_format($total_price_excl, 2, ',', '.') }}</p>

                            <p>BTW: €{{number_format($total_vat, 2, ',', '.')}}</p>
                            <p>Totale prijs: €{{number_format($total, 2, ',', '.')}}</p>
                        </div>
                        <div class="row">
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col-md-2 text-end">
                                <a href="{{ route('cart.details') }}" class="text-decoration-none">Gegevens wijzigen</a>
                            </div>
                            <div class="col-md-2">
                                <div id="paypal-button-container" class="w-25"></div>
                            </div>
                            <!-- <button class="btn btn-dark ms-2" onclick="$(this).addClass('disabled')">Afrekenen</button> -->


                            <script>
                                paypal.Buttons({



                                    // Sets up the transaction when a payment button is clicked
                                    style: {
                                        color: 'black',

                                        label: 'pay',

                                    },
                                    createOrder: (data, actions) => {
                                        return actions.order.create({
                                            method: "post",
                                            purchase_units: [{

                                                amount: {
                                                    value: '<?= number_format($total, 2, '.', '')   ?>', // Can also reference a variable or function

                                                }
                                            }]
                                        });
                                    },
                                    // Finalize the transaction after payer approval
                                    onApprove: (data, actions) => {




                                        return fetch("<?= route('order.storeOrder') ?>", {

                                            method: "post",
                                            headers: {
                                                'X-CSRF-TOKEN': $('input[name="_token"]').val()
                                            },




                                        }).then(function() {
                                            window.location.href = "<?= route('products') ?>";




                                        });
                                    }
                                }).render('#paypal-button-container');
                            </script>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        @else
        <div class="col-md-12">
            <h1>Uw winkelwagen is leeg</h1>
            <a href="{{ route('products') }}" class="text-decoration-none">Bekijk producten</a>
        </div>

        @endif

    </div>
</div>
@endsection