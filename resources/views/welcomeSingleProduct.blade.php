@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center g-5">


        <div class="col-md-12">
            <div class="row mb-3">

                <div class="col">
                    <h1>{{ $product->name }}</h1>
                </div>



            </div>
            <div class="row">
                <div class="col-md-8">

                    <div class="card border-0">


                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <img src="/images/{{ $product->image }}" class="img-fluid rounded-start" alt="...">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0">
                        <div class="card-body">
                            @if($product->discount_price)
                            <h3 class="text-danger">Originele prijs: €<del>{{ number_format($product->price, 2, ',', '.' )}}</del></h3>
                            <p>Nu voor: €{{ number_format($product->discount_price, 2, ',', '.' ) }}</p>
                            @else
                            <h3 class="text-danger">€{{ number_format($product->price, 2, ',', '.' )}}</h3>
                            @endif



                            <form action="{{ route('cart.add', $product)}}" method="POST">
                                @csrf
                                <button class="btn btn-outline-dark">Toevoegen aan winkelwagen</button>
                            </form>
                        </div>
                    </div>
                </div>



            </div>
            <div class="row mt-3">
                <div class="col-md-8">
                    <div class="card border-0">
                        <div class="card-body ">

                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            Productbeschrijving
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">{!! $product->description !!}</div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>




                </div>


                <div class="col-md-4">
                    <h5>Bekijk ook eens</h5>
                    <div class="card border-0">
                        <div class="card-body">

                            <div class="card-group g-2">
                                @foreach($products as $product)

                                <div class="card">
                                    <img src="/images/{{ $product->image }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <p class="card-text">{{$product->name}}</p>
                                        <p>€{{ number_format($product->price, 2, ',', '.' )}}</p>
                                    </div>
                                    <a href="{{ route('show', $product) }}" class="stretched-link"></a>
                                </div>

                                @endforeach
                            </div>


                        </div>
                        <div class="card align-items-center border border-0 mt-3">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection