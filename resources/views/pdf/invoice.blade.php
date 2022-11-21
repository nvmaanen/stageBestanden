<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $order->id }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    .w-100 {
      width: 100%;
    }

    .bg-primary {
      background-color: #F4F9F1;
    }

    table,
    td,
    th {
      border-bottom: 1px, solid #ddd;
      text-align: left;
    }

    th,
    td {
      padding: 8px;
      vertical-align: top;
    }
  </style>
</head>
@php

$total = 0;
$vat = 0;

@endphp

<body>
  <h1>Bestelling {{ $order->id }}</h1>
  <div class="row">

    <div class="col">Naam: {{ $order->name }}</div>

  </div>
  <div class="row">

    <div class="col">Email: {{ $order->email }}</div>

  </div>
  <div class="row">

    <div class="col">Adres: {{ $order->address }}</div>

  </div>
  <div class="row">

    <div class="col">Postcode: {{ $order->zipcode }}</div>

  </div>
  <div class="row mb-3">

    <div class="col">Woonplaats: {{ $order->residence }}</div>

  </div>


  <hr>

  <table class="table">
    <thead>


      <tr>
        <th scope="col">Product</th>
        <th scope="col">Hoeveelheid</th>
        <th scope="col">Prijs</th>
        <th>Kortingsprijs</th>
        <th scope="col">BTW</th>

      </tr>
    </thead>
    <tbody>

      @foreach($order->products as $product)
      <tr>
        <td>{{ $product->product->name }}</td>
        <td>{{ $product->quantity }}</td>
        <td>€{{ $product->price }}</td>
        <td>€{{ $product->discount_price }}</td>
        <td>{{ $product->vat }}%</td>
        @php
        $total += $product->price * $product->quantity;
        $vat += ( $product->price * $product->quantity * $product->vat / 100);
        @endphp

      </tr>
      @endforeach



    </tbody>

  </table>

  <hr>

  <div class="row">
    <div class="col text-end">
      <p>Exclusief btw: €{{ number_format($total, 2, ',', '.' ) }}</p>
      <p>BTW: €{{ number_format($vat, 2, ',', '.' ) }}</p>
      <p>Totale prijs: €{{ number_format($order->total_price, 2, ',', '.' ) }}</p>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>