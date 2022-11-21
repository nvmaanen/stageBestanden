@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center g-5">
        <div class="col-md-2">
            @include('menu/sidemenu')
        </div>

        <div class="col-md-10">
            @if (session('statusCreate'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('statusCreate') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('statusDelete'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('statusDelete') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('statusUpdate'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('statusUpdate') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="row mb-3">
                <div class="col-md-4">
                    <h1>{{ __('Alle producten') }}</h1>
                </div>
                <div class="col-md-4">
                    <form class="d-flex" role="search" method="GET" action="{{ route('admin.products.search') }}">
                        <input class="form-control me-2" type="search" placeholder="Zoeken" aria-label="Search" name="search">
                        <button class="btn btn-dark" type="submit">Zoeken</button>
                    </form>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-dark">Product aanmaken</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th>Prijs</th>
                                <th>Kortingsprijs</th>
                                <th>BTW</th>

                                <th scope="col">Bewerken</th>


                                <th scope="col">Verwijderen</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td><a href="{{ route('admin.products.show', $product) }}" class="text-decoration-none">{{ $product->name }}</a></td>
                                <td>€{{ number_format($product->price, 2, ',', '.' )}}</td>
                                <td>€{{ number_format($product->discount_price, 2, ',', '.') }}</td>
                                <td>{{ $product->vat }}%</td>

                                <td><a href="{{ route('admin.products.edit', $product) }}" class="text-decoration-none">Bewerken</a></td>
                                <td><a href="" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#product{{ $product->id }}">Verwijderen</a></td>




                                <div class="modal fade" id="product{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Weet je zeker dat je {{ $product->name }} wilt verwijderen?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">

                                                    <div class="col text-end">
                                                        <form action="{{ route('admin.products.destroy',  $product) }}" method="POST" class="inline">
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
                    <div class="card align-items-center border border-0 mt-3">
                        {{ $products->links() }}
                    </div>



                </div>
            </div>

        </div>
    </div>
</div>
@endsection