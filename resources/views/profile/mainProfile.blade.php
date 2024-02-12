@php use Illuminate\Support\Facades\Auth; @endphp
@extends('base')

@section('title')
    profile
@endsection

@section("content")
    @auth()
        <h1>Vous êtes connecté en tant que {{ Auth::user()->firstname }} {{ Auth::user()->name }} comme {{ Auth::user()->rôle }}</h1>

        <form class="nav-item" action="{{route('auth.logout')}}" method="post">
    @method('delete')
        @csrf
        <button class="nav-link">Se déconnecter</button>
    </form>

        <div class="container mt-5">
            <h2>Panel {{Auth::user()->rôle}}</h2>
            <ul class="list-group">

                <li class="list-group-item">Changer vos informations personnelles</li>
                <li class="list-group-item">Choisir des articles à mettre à votre panier de favoris</li>
                <li class="list-group-item">Effectuer une recherche à l'aide de la barre de recherche se trouvant dans la navbar</li>
                @if (Auth::user()->rôle == "Admin")
                    <li class="list-group-item">Vous balader sur votre profil administrateur</li>
                    <li class="list-group-item">Créer de nouveaux articles</li>
                    <li class="list-group-item">Updater un article déjà existant</li>
                @endif
            </ul>
        </div>

    @endauth
    @guest()
        <h1>Vous n'avez pas le droit d'être là. Vous devez vous connecter</h1>
    @endguest

@endsection
