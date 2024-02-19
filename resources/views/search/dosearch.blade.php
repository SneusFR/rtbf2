@extends('base')

@section('title')
    Recherchez votre article
@endsection

@section('content')

    <main class="{{$theme == 'Dark' ? 'dark-home-index' : 'home-index'}} container">

        <div class="wrapper">

            <H1 class="{{$theme == 'Dark' ? 'dark-h1rec' : 'h1rec'}}">RECHERCHE</H1>

            <h4 class="h4rec">Recherchez parmi nos articles et publications</h4>

            <form action="{{ route('blog.search') }}" method="POST">
                @csrf
                <input id="search-bar" placeholder="Rechercher un article, un sujet..." name="query" type="text" value="{{ old('query') }}">
            </form>

            <div class="py-5">
                @foreach($posts as $post)

                    <a href="{{route('blog.show', ['slug' => $post->slug, 'post' => $post->id]) }}">

                        <article class="{{$theme == 'Dark' ? 'dark-article-search' : 'article-search'}}">

                        <h5>{{$post->categorie}}</h5>
                        <h4>{{$post->titleArt}}</h4>
                        <span class="time">il y a 2 heures<span class="point"> . </span>3 min</span>

                        </article>
                    </a>
                @endforeach

            </div>
        </div>

    </main>

@endsection
