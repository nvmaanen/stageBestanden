@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center g-5">
        <div class="col-md-2">
            @include('menu/sidemenu')
        </div>

        <div class="col-md-10">
            <div class="row">
                <div class="col-md-8">
                    <h1>{{ __('Product bewerken') }}</h1>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form class="row g-3" action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">

                            <label for="name" class="form-label">Product naam</label>
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input name="name" type="text" class="form-control" id="name" placeholder="Koop een auto, krijg een gratis pizza" value="{{ $product->name ?? '' }}" required>
                        </div>

                        <div class="col-12 mb-3">

                            <label for="description" class="form-label">Schrijf een beschrijving</label>
                            @error('description')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <textarea class="form-control" name="description" id="description" rows="5" placeholder="Bij je lokale autodealer krijg je nu..." value="{{ $product->description ?? '' }}">{{ $product->description }}</textarea>
                        </div>


                        <div class="mb-3">
                            <label for="image" class="form-label">Kies een afbeelding</label>
                            <input class="form-control" type="file" id="image" name="image" value="{{ $product->image ?? '' }}">
                        </div>

                        <label for="price" class="form-label">Wat is de prijs?</label>
                        @error('price')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <div class="input-group mb-3">

                            <span class="input-group-text">€</span>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest euro)" id="price" name="price" value="{{ $product->price }}" required>
                        </div>
                        <label for="discount_price" class="form-label">Kies de kortingsprijs</label>
                        @error('discount_price')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <div class="input-group mb-3">

                            <span class="input-group-text">€</span>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest euro)" id="discount_price" name="discount_price" value="{{ $product->discount_price }}">
                            <!-- <span class="input-group-text">.00</span> -->
                        </div>

                        <label for="vat" class="form-label">Wat is het BTW percentage?</label>
                        @error('vat')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <div class="input-group mb-3">

                            <input type="text" class="form-control" aria-label="Amount (to the nearest euro)" id="vat" name="vat" value="{{ $product->vat }}" required>
                            <span class="input-group-text">%</span>
                        </div>



                        <div class="col-12 text-end">
                            <a href="{{ route('admin.products.index') }}" class="text-decoration-none">Annuleren</a>
                            <button type="submit" class="btn btn-dark ms-2">Opslaan</button>
                        </div>


                    </form>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection