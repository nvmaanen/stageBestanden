@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center g-5">
        <div class="col-md-2">
            @include('menu/sidemenu')
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="col-md-12">
                    <div class="card card-cover h-100 overflow-hidden rounded-0 text-bg-dark" style="background-image: url(/images/{{ $article->image }}); background-size: cover">
                    <div class="d-flex flex-column h-100 p-5 text-white text-shadow-1">
                                            <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">{{ $article->title }}</h3>
                                               
                                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Geschreven door:  {{ $article->user->name }}</p>
                        </div>
                    </div>

                    <p class="card-text">{{ $article->intro }}</p>
                    <p class="card-text">{!! $article->content !!}</p>


                </div>
            
           

            
            </div>

        </div>
            <div class="col-md-2">
                <div class="card">
                    <div class="card-header">Andere artikelen</div>
                    <div class="list-group list-group-flush">
                        @foreach($articles as $article)
                            <small><a href="{{ route('admin.articles.show', $article) }}" class="text-decoration-none list-group-item list-group-item-action">{{ $article->title }}</a></small>
                        @endforeach
                    </div>
                </div>
                
            </div>
    </div>
</div>
@endsection