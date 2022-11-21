@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center g-5">
        <div class="col-md-2">
            @include('menu/sidemenu')
        </div>
        <div class="col-md-10">
            @if (session('statusDelete'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('statusDelete') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <h1>{{ __('Gevonden bestellingen') }}</h1>
                </div>
                <div class="col-md-4">
                    <form class="d-flex" role="search" method="GET" action="{{ route('admin.orders.search') }}">
                        <input class="form-control me-2" type="search" placeholder="Zoeken" aria-label="Search" name="search">
                        <button class="btn btn-outline-dark" type="submit">Zoeken</button>
                    </form>
                </div>

            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Naam</th>
                                <th>Prijs</th>
                                <th>Besteldatum</th>
                                <th>Status</th>
                                <th scope="col">Verwijderen</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td><a href="{{ route('admin.orders.view', $order) }}" class="text-decoration-none">{{ __('Bestelling') }} {{ $order->id }}</a></td>
                                <td>€{{number_format($order->total_price, 2, ',', '.')}}</td>
                                <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                                @if($order->status == 0)
                                <td>Offerte</td>
                                @else
                                <td>Factuur</td>
                                @endif

                                <td><a href="" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#order{{ $order->id }}">Verwijderen</a></td>




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




                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection