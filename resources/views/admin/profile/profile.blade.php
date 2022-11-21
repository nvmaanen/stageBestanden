@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center g-5">
            <div class="col-md-2">
                @include('menu/sidemenu')
            </div>
        

            <div class="col-md-10">
                        @if (session('NameUpdate'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                {{ session('NameUpdate') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('EmailUpdate'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                {{ session('EmailUpdate') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('PasswordUpdate'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                {{ session('PasswordUpdate') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                <div class="col mb-3">
                    <h1>{{ $users->name}}'s profiel</h1>
                </div>
                <div class="card">
                    
                    <div class="card-body">
                  
                        
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Gebruikersnaam wijzigen
                            </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <form class="row g-3" action="{{ route('admin.profile.updateUsername', $users) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Wijzig je gebruikersnaam</label>
                                            <input name="name" type="text" class="form-control" id="name" placeholder="{{ $users->name}}" value="{{ $users->name ?? '' }}" required>
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-dark">Wijzigen</button>
                                        </div>
                                    </form>
                                        
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                E-mail adres wijzigen
                            </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                <form class="row g-3" action="{{ route('admin.profile.updateEmail', $users) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Wijzig je E-mail adres</label>
                                            <input name="email" type="text" class="form-control" id="email" placeholder="email@email.com" value="{{ $users->email}}" required>
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-dark">Wijzigen</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                Wachtwoord wijzigen
                            </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                <form class="row g-3" action="{{ route('admin.profile.updatePassword', $users) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-md-6">
                                            <label for="password" class="form-label">Wijzig je wachtwoord</label>
                                            
                                            <input name="password" type="password" class="form-control" id="password">
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-dark">Wijzigen</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                       

                    


                    

                </div>
                
            </div>
            <div class="card mt-4">
                <div class="card-header"><h5>Geschreven artikelen</h5></div>
                @if(count($articles) > 0)
                    <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Artikel</th>
                                <th scope="col">Publicatiedatum</th>
                                <th scope="col">Bewerken</th>
                                

                                <th scope="col">Verwijderen</th>
                        
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($articles as $article)
                            <tr>
                                <td><a href="{{ route('admin.articles.show', $article) }}" class="text-decoration-none">{{ $article->title }}</a></td>
                                <td>{{ date('d-m-Y', strtotime($article->date)) }}</td>
                                <td><a href="{{ route('admin.articles.edit', $article) }}" class="text-decoration-none">Bewerken</a></td>
                                <td><a href="" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#article{{ $article->id }}">Verwijderen</a></td>
                          
                


                                    <div class="modal fade" id="article{{ $article->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Weet je zeker dat je {{ $article->title }} wilt verwijderen?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                            
                                            <div class="col text-end">
                                                <form action="{{ route('admin.articles.destroy',  $article) }}" method="POST" class="inline">
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
                        {{ $articles->links() }}
                    </div>
                        
                    </div>
                </div>
                @else
                <div class="alert alert-warning  fade show text-center" role="alert">
                    <p>Je hebt nog geen artikel geschreven</p>
                    <button type="button" class="btn btn-dark"><a href="{{ route('admin.articles.create') }}" class="text-decoration-none text-white">Schrijf een artikel</a></button>           
                </div>
                            
                @endif
        </div>
        </div>
    </div>
@endsection