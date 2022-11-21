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
                    <h1>{{ __('Artikel bewerken') }}</h1>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                <form class="row g-3" action="{{ route('admin.articles.update', ['article' => $article]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">
                            <label for="title" class="form-label">Bedenk een titel</label>
                            <input name="title" type="text" class="form-control" id="title" placeholder="Koop een auto, krijg een gratis pizza" value="{{ $article->title ?? '' }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="intro" class="form-label">Schrijf een inleiding</label>
                            <input name="intro" type="text" class="form-control" id="intro" placeholder="Koop een auto, krijg een gratis pizza" value="{{ $article->intro ?? '' }}" required>
                        </div>
                        
                       

                        <div class="col-12 mb-3">
                            <label for="content" class="form-label">Schrijf de content</label>
                            <textarea class="form-control" name="content" id="content" rows="5" placeholder="Bij je lokale autodealer krijg je nu..." value="{{ $article->content ?? '' }}">{{ $article->content }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label for="date">Publicatie datum</label>
                                <input type="date" id="date" name="date" class="form-control" value="{{ old('date') ?? $article->date }}" required>
                            </div>

                            <div class="col-6">
                                <label for="ExpDate">Verval datum</label>
                                <input type="date" id="ExpDate" name="ExpDate" class="form-control" value="{{ old('ExpDate') ?? $article->ExpDate }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Kies een afbeelding</label>
                            <input class="form-control" type="file" id="image" name="image" value="{{ $article->image ?? '' }}" required>
                        </div>
                        
                        
                        <div class="col-12 text-end">
                            <a href="{{ route('admin.articles.index') }}" class="text-decoration-none">Annuleren</a>
                            <button type="submit" class="btn btn-dark ms-2">Opslaan</button>
                        </div>
                        
                        
                    </form>

                
                </div>
            </div>

        </div>
    </div>
</div>
@endsection