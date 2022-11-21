<div class="card">
    <div class="card-header">
        <h3>Menu</h3>
    </div>
    <div class="list-group list-group-flush">

        <a href="{{ route('home') }}" class="list-group-item list-group-item-action">Overzicht</a>
        <a href="{{ route('admin.articles.index') }}" class="list-group-item list-group-item-action">Artikelen</a>
        <a href="{{ route('admin.projects.index') }}" class="list-group-item list-group-item-action">Projecten</a>
        <a href="{{ route('admin.tasks.index') }}" class="list-group-item list-group-item-action">Taken</a>

        <a href="{{ route('admin.companies.index') }}" class="list-group-item list-group-item-action">Bedrijven</a>
        <a href="{{ route('admin.employees.index') }}" class="list-group-item list-group-item-action">Medewerkers</a>
        <a href="{{ route('admin.products.index') }}" class="list-group-item list-group-item-action">Producten</a>
        <a href="{{ route('admin.orders.index') }}" class="list-group-item list-group-item-action">Bestellingen</a>
        <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">Gebruikers</a>


        <a href="{{ route('admin.profile.index') }}" class="list-group-item list-group-item-action">Profiel</a>


        <a href="{{ route('logout') }}" class="list-group-item list-group-item-action" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Uitloggen</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>