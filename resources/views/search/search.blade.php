@extends('base')

@section('title')
    Recherchez votre article
@endsection

@section('content')

    <main class="{{$theme == 'Dark' ? 'dark-home-user' : 'home-user'}} container">

        <div class="wrapper">

            <H1 class="h1rec">RECHERCHE</H1>

            <h4 class="h4rec">Recherchez parmi nos articles et publications</h4>

            <form action="{{ route('blog.search') }}" method="POST">
                @csrf
                <input id="search-bar" placeholder="Rechercher un article, un sujet..." name="query" type="text" value="{{ old('query') }}">
            </form>

            <div class="d-flex justify-content-center py-5">

                <img src="/img/NoSearchImg.svg" id="noresult" alt="Aucun résultat">

            </div>
        </div>

    </main>

@endsection
