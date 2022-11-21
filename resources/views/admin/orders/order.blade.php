@extends('layouts.app')
@php

$total = 0;
$total_price_excl = 0;
$total_vat = 0;
$total_discount = 0;


@endphp
@section('content')
<div class="container mt-3">
    <div class="row justify-content-center g-5">
        <div class="col-md-2">
            @include('menu/sidemenu')
        </div>
        <div class="col-md-8">
            @if (session('statusUpdate'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('statusUpdate') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="row">
                <div class="col-md-8">
                    @if($order->status == 1)
                    <h1>{{ __('Bestelling') }} {{ $order->id }}</h1>
                    @else
                    <h1>{{ __('Offerte') }} {{ $order->id }}</h1>
                    @endif
                </div>
                <div class="col-md-4 text-end">
                    <div class="dropdown-center">
                        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Opties
                        </button>
                        <ul class="dropdown-menu">
                            @if($order->status == 0)
                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addProduct{{ $order->id }}">Product toevoegen</a></li>
                            <li><a href="{{ route('admin.orders.offerte', $order) }}" class="dropdown-item">Offerte versturen</a></li>
                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#change{{ $order->id }}">Omzetten naar factuur</a></li>
                            @else
                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changeBack{{ $order->id }}">Omzetten naar offerte</a></li>
                            @endif
                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#order{{ $order->id }}">Verwijderen</a></li>
                        </ul>
                    </div>
                </div>


                <div class="modal fade" id="addProduct{{ $order->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Welk product zou je willen toevoegen?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col text-end">
                                        <form action="{{ route('admin.orders.add', [$order]) }}" method="POST" class="inline">
                                            @csrf
                                            <select class="form-select mb-3" name="product_id" aria-label="Default select example">

                                                @foreach ($products as $product)

                                                <option value="{{ $product->id }}">{{ $product->name }}</option>

                                                @endforeach
                                            </select>

                                            <button type="submit" class="btn btn-outline-dark">Toevoegen</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal fade" id="order{{ $order->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Weet je zeker dat je deze bestelling wilt verwijderen?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col text-end">
                                        <form action="{{ route('admin.orders.delete',  $order) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Verwijderen</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal fade" id="change{{ $order->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Weet je zeker dat je deze bestelling wilt omzetten naar een factuur?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col text-end">
                                        <form action="{{ route('admin.orders.change', $order) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PUT')

                                            <input type="hidden" name="status" id="status" value="1">

                                            <button type="submit" class="btn btn-danger">Omzetten</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal fade" id="changeBack{{ $order->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Weet je zeker dat je deze bestelling wilt omzetten naar een offerte?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col text-end">
                                        <form action="{{ route('admin.orders.changeBack', $order) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PUT')

                                            <input type="hidden" name="status" id="status" value="0">

                                            <button type="submit" class="btn btn-danger">Omzetten</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Overzicht</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.orders.edit', $order) }}">Gegevens</a>
                    </li>

                </ul>
                <div class="card-body">
                    <div class="row">

                        <div class="col">
                            Naam: {{ $order->name }} <br>
                            Email: {{ $order->email }} <br>
                            Adres: {{ $order->address }} <br>
                            Postcode: {{ $order->zipcode }} <br>
                            Woonplaats: {{ $order->residence }}
                        </div>
                        <div class="col text-end">
                            <a href="{{ route('admin.orders.download', $order) }}" class="btn btn-sm btn-dark">PDF</a><br>

                        </div>



                    </div>


                    <table class="table table-bordered mt-4">
                        @error('discount_price')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('quantity')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <thead>
                            <tr>
                                <th>Afbeelding</th>
                                <th>Product</th>
                                <th>Aantal</th>
                                <th>Prijs per stuk</th>
                                <th>Korting per stuk</th>
                                <th>BTW</th>
                                <th>Totaal</th>
                                @if($order->status == 0)
                                <th>Verwijderen</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->products as $item)
                            <tr>
                                <td><img src="/images/{{ $item->product->image }}" alt="{{ $item->product->image }}" class="img-fluid" style="max-width: 140px;"></td>
                                <td>{{ $item->product->name }}</td>

                                <td>

                                    <form action="{{ route('admin.orders.update.quantity', [$order, $item]) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" id="price" name="price" value="{{ $item->price }}">
                                        <input type="hidden" id="discount_price" name="discount_price" value="{{ $item->discount_price }}">
                                        <input type="number" id="quantity" name="quantity" value="{{ $item->quantity }}" onchange="this.form.submit()" class="form-control">
                                    </form>
                                </td>
                                <td>€{{ number_format($item->price, 2, ',', '.') }}</td>
                                <td>

                                    <form action="{{ route('admin.orders.updatePrice', [$order, $item]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" id="price" name="price" value="{{ $item->price }}">
                                        <input type="hidden" id="quantity" name="quantity" value="{{ $item->quantity }}">
                                        <input type="number" onchange="this.form.submit()" name="discount_price" value="{{ $item->discount_price }}" class="form-control" />
                                        <input type="hidden" name="product_id" value="{{ $item->product->id}}">
                                        <input type="hidden" name="order_id" value="{{ $order->id}}">
                                    </form>
                                </td>
                                <td>{{ $item->vat }}%</td>
                                @if($item->discount_price)

                                <td>€{{ number_format($item->discount_price * $item->quantity, 2, ',', '.') }}</td>
                                @else

                                <td>€{{number_format($item->price * $item->quantity, 2, ',', '.') }}</td>
                                @endif
                                @if($order->status == 0)
                                <td><a href="" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#product{{ $item->id }}">Verwijderen</a></td>
                                @endif
                                <div class="modal fade" id="product{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Weet je zeker dat je {{ $item->product->name }} verwijderen?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">

                                                    <div class="col text-end">
                                                        <form action="{{ route('admin.orders.destroy', [$order, $item->product]) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Verwijderen</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </tr>
                            @php
                            if ($item->discount_price) {
                            $total += $item->discount_price * $item->quantity * ($item->vat / 100) + $item->discount_price * $item->quantity;
                            $total_price_excl += $item->discount_price * $item->quantity;
                            $total_vat += $item->discount_price * $item->quantity * ($item->vat / 100);
                            $total_discount += ($item->price * $item->quantity) - ($item->discount_price * $item->quantity);
                            } else {
                            $total += $item->price * $item->quantity * ($item->vat / 100) + $item->price * $item->quantity;
                            $total_price_excl += $item->price * $item->quantity;
                            $total_vat += $item->price * $item->quantity * ($item->vat / 100);
                            }

                            @endphp



                            @endforeach
                        </tbody>
                    </table>







                </div>
            </div>




        </div>

        <div class="col-md-2">
            <div class="card">
                <div class="card-header">Overzicht</div>
                <div class="card-body">

                    @if( $total_discount)
                    <p>Totale korting: € -{{ number_format($total_discount, 2, ',', '.') }}</p>
                    <p>Subtotaal: €{{ number_format($total_price_excl, 2, ',', '.') }}</p>
                    <p>BTW: €{{ number_format($total_vat, 2, ',', '.') }}</p>
                    <p>Totaal: €{{number_format($total, 2, ',', '.')}}</p>
                    @else
                    <p>Subtotaal: €{{ number_format($total_price_excl, 2, ',', '.') }}</p>
                    <p>BTW: €{{ number_format($total_vat, 2, ',', '.') }}</p>
                    <p>Totaal: €{{number_format($total, 2, ',', '.')}}</p>

                    @endif



                </div>
            </div>
        </div>

    </div>
</div>
@endsection