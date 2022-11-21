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
                    <h1>{{ __('Project aanmaken') }}</h1>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                <form class="row g-3" action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-6">
                            <label for="title" class="form-label">Bedenk een titel</label>
                            <input name="title" type="text" class="form-control" id="title" placeholder="Koop een auto, krijg een gratis pizza" value="{{ $article->title ?? '' }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="intro" class="form-label">Schrijf een inleiding</label>
                            <input name="intro" type="text" class="form-control" id="intro" placeholder="Koop een auto, krijg een gratis pizza" value="{{ $article->intro ?? '' }}" required>
                        </div>
                        
                       

                        <div class="col-12 mb-3">
                            <label for="description" class="form-label">Schrijf de content</label>
                            <textarea class="form-control" name="description" id="description" rows="5" placeholder="Bij je lokale autodealer krijg je nu..." value="{{ $article->description ?? '' }}"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label for="StartDate">Publicatie datum</label>
                                <input type="date" id="StartDate" name="StartDate" class="form-control" value="{{ isset($article) ? $article->StartDate->format('d-m-Y') : '' }}" required>
                            </div>

                            <div class="col-6">
                                <label for="EndDate">Verval datum</label>
                                <input type="date" id="EndDate" name="EndDate" class="form-control" value="{{ isset($article) ? $article->EndDate->format('d-m-Y') : '' }}" required>
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