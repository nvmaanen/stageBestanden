<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>NieuweCrud</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <style>
        body {
            font-family: 'Nunito';
        }
    </style>
</head>

<body class="antialiased">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ __('NieuweCrud') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="vr"></div>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="{{ route('articles') }}" class="nav-link">Artikelen</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('projects') }}" class="nav-link">Projecten</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('products') }}" class="nav-link">Producten</a>
                    </li>

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <ul class="navbar-nav me-auto">

                        <li class="nav-item">
                            <a href="{{ route('cart.index') }}" class="nav-link">Winkelwagen</a>
                        </li>

                    </ul>
                    <div class="vr"></div>

                    <!-- Authentication Links -->
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else

                    @if(Auth::user()->role_id==1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">{{ __('admin') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endif
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <div class="container mt-5">
            <div class="col-md-12 mb-5">
                @if (session('statusOrder'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('statusOrder') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <h1>{{ __('Gevonden producten') }}</h1>
                    </div>
                    <div class="col-md-4">
                        <form class="d-flex" role="search" method="GET" action="">
                            <input class="form-control me-2" type="search" placeholder="Zoeken" aria-label="Search" name="search">
                            <button class="btn btn-dark" type="submit">Zoeken</button>
                        </form>
                    </div>
                </div>

                @if(count($products) > 0)
                <div class="card">
                    <div class="container">
                        <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-3">
                            @foreach($products as $product)



                            <div class="col">
                                <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image: url(/images/{{ $product->image }}); background-size: cover;">


                                    <a href="{{ route('show', $product) }}" class="stretched-link"></a>

                                    <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                                        <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">{{ $product->name}}</h3>

                                    </div>
                                    <li class="d-flex align-items-center ms-3" style="background-color:aliceblue">

                                        <small class="text-dark">€{{ $product->price }}</small>

                                    </li>

                                </div>


                            </div>




                            @endforeach





                            @else

                            <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                                <p>Er bestaan nog geen Producten</p>

                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </main>





</body>

</html>