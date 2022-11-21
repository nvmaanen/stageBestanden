<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestel bevestiging</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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

<body>
    @php
    $customer = session()->get('customer');
    $items = session()->get('products');
    @endphp
    <h1>NieuweCrud</h1>
    <hr>
    <h3>Bestelling</h3>
    <div class="col">
        Bestelnummer: {{$order->id}} <br>
        Naam: {{ $order->name }} <br>
        Email: {{ $order->email }} <br>
        Adres: {{ $order->address }} <br>
        Postcode: {{ $order->zipcode }} <br>
        Woonplaats: {{ $order->residence }}
    </div>
    <hr>
    <table class="table">
        <thead>
            <th>Product</th>
            <th>Hoeveelheid</th>
            <th>Prijs per stuk</th>
            <th>Korting prijs per stuk</th>
            <th>Totaal</th>
            <th>BTW</th>
        </thead>

        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item['product']->name }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>€{{ $item['product']->price }}</td>
                @if($item['product']->discount_price)
                <td>€{{ number_format($item['product']->discount_price, 2, ',', '.') }}</td>
                <td>€{{ number_format($item['product']->discount_price * $item["quantity"], 2, ',', '.') }}</td>
                @else
                <td>-</td>
                <td>€{{number_format($item["product"]->price * $item["quantity"], 2, ',', '.') }}</td>
                @endif

                <td>{{ $item['product']->vat }}%</td>
            </tr>
            @endforeach
        </tbody>

    </table>
    <hr>
    <p>Subtotaal: €{{number_format($order->total_price_excl, 2, ',', '.')}}</p>
    <p>BTW: €{{number_format($order->total_vat, 2, ',', '.')}}</p>
    <p>Totale prijs: €{{number_format($order->total_price, 2, ',', '.')}}</p>
</body>

</html>