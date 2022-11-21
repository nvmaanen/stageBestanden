@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center g-5">
        <div class="col-md-2">
            @include('menu/sidemenu')
        </div>

        <div class="col-md-10">
            <div class="row mb-3">

                <div class="col">
                    <h1>{{ $product->name }}</h1>
                </div>



            </div>

            <div class="card">


                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <img src="/images/{{ $product->image }}" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col">

                        </div>
                        <div class="col">
                            @if($product->discount_price)
                            <h3 class="text-danger">Originele prijs: €<del>{{ number_format($product->price, 2, ',', '.' )}}</del></h3>
                            <p>Nu voor: €{{ number_format($product->discount_price, 2, ',', '.' ) }}</p>
                            @else
                            <h3 class="text-danger">€{{ number_format($product->price, 2, ',', '.' )}}</h3>
                            @endif

                        </div>

                    </div>







                    <p class="card-text">{!! $product->description !!}</p>







                </div>




            </div>

        </div>

    </div>
</div>
@endsection