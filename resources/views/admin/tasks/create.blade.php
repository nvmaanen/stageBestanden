@extends('layouts.app')

@section('content')
<div class="container mb-5">
    <div class="row justify-content-center g-5">

        <div class="col-md-2">
            @include('menu/sidemenu')
        </div>

        <div class="col-md-10">
            <h1 class="mb-3">{{ __('Taak aanmaken') }}</h1>
            <div class="card mb-5">



                <div class="card-body">
                    <form class="row g-3" action="{{ route('admin.tasks.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf


                        <div class="col-md-6">
                            <label for="task" class="form-label">Bedenk een titel</label>
                            <input name="task" type="text" class="form-control" id="task" placeholder="Koop een auto, krijg een gratis pizza" value="" required>
                        </div>



                        <div class="col-12 mb-3">
                            <label for="description" class="form-label">Schrijf een beschrijving</label>
                            <textarea class="form-control" name="description" id="description" rows="5" placeholder="Bij je lokale autodealer krijg je nu..." value=""></textarea>
                        </div>



                        <div class="row">
                            <div class="col-6">
                                <label for="startDate">Start datum</label>
                                <input type="date" id="startDate" name="startDate" class="form-control" value="" required>
                            </div>

                            <div class="col-6">
                                <label for="endDate">Deadline</label>
                                <input type="date" id="endDate" name="endDate" class="form-control" value="" required>
                            </div>
                        </div>



                        <div class="col-12 text-end">
                            <a href="" class="text-decoration-none">Annuleren</a>
                            <button type="submit" class="btn btn-dark ms-2">Opslaan</button>
                        </div>



                    </form>





                </div>
            </div>
        </div>
    </div>
</div>
@endsection