<div class="card">
    <div class="card-header">
        <h3>Menu</h3>
    </div>
    <div class="list-group list-group-flush">

        <a href="{{ route('home') }}" class="list-group-item list-group-item-action">Overzicht</a>
        <a href="" class="list-group-item list-group-item-action">Mijn taken</a>
        <a href="{{ route('user.projects.index') }}" class="list-group-item list-group-item-action">Mijn projecten</a>



        <a href="{{ route('logout') }}" class="list-group-item list-group-item-action" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Uitloggen</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>