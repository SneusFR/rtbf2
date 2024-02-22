@php use Illuminate\Support\Facades\Auth; @endphp
@extends('base')

@section('title')
    profile
@endsection

@section("content")
    <main class="{{$theme == 'Dark' ? 'dark-home-user' : 'home-user'}} container">

        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>


            @elseif(session('fail'))
                <div class="alert alert-danger">
                    {{session('fail')}}
                </div>
            @endif
        </div>

        <div class="wrapper">
            @auth()
                <h1 class="h1prof">Vous êtes connecté en tant que {{ Auth::user()->firstname }} {{ Auth::user()->name }} comme {{ Auth::user()->role }}</h1>

                <form class="nav-item" action="{{route('auth.logout')}}" method="post">
            @method('delete')
                @csrf
                <button class="btn-deco col-12">Se déconnecter</button>
            </form>

                <div class="mt-3">
                    <h2 class="h2prof">Panel {{Auth::user()->role}}</h2>
                    <ul class="list-group">

                        <li class="list-group-item li-prof"> <a href="{{route('profile.edit')}}">Changer vos informations personnelles <img src="/img/user_black.svg"> </a> </li>
                        <li class="list-group-item li-prof"> <a href="{{route('blog.index')}}"> Choisir des articles à mettre dans votre panier de favoris <img src="/img/star-filled.svg"></a> </li>
                        <li class="list-group-item li-prof"> <a href="{{route('blog.search')}}"> Effectuer une recherche à l'aide de la barre de recherche sur l'icône <img src="/img/search_black.svg"> </a> </li>
                        @if (Auth::user()->role == "Admin")
                            <li class="list-group-item li-prof"> <a href="{{route('profile.profile')}}"> Vous balader sur votre profil administrateur <img src="/img/user_black.svg"> </a> </li>
                            <li class="list-group-item li-prof"> <a href="{{route('blog.create')}}"> Créer de nouveaux articles <img src="/img/article_logo_black.svg"> </a> </li>
                            <li class="list-group-item li-prof"> <a href="{{route('blog.create')}}"> Updater un article déjà existant <img src="/img/article_logo_black.svg"> </a> </li>
                        @endif

                    </ul>
                </div>

            @endauth
            @guest()
                <h1>Vous n'avez pas le droit d'être là. Vous devez vous connecter</h1>
            @endguest
        </div>
    </main>

@endsection
