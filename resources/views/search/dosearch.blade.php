@extends('base')

@section('title')
    Recherchez votre article
@endsection

@section('content')

    <main class="home-user container">

        <div class="wrapper">

            <H1 class="h1rec">RECHERCHE</H1>

            <h4 class="h4rec">Recherchez parmi nos articles et publications</h4>

            <form action="{{ route('blog.search') }}" method="POST">
                @csrf
                <input id="search-bar" placeholder="Rechercher un article, un sujet..." name="query" type="text" value="{{ old('query') }}">
            </form>



            <div class="d-flex justify-content-center py-5">
                @foreach($posts as $post)


                <article class="article-4">

                    <a href="{{route('blog.show', ['slug' => $post->slug, 'post' => $post->id]) }}">
                        <h5>{{$post->categorie}}</h5>
                        <h4>{{$post->titleArt}}</h4>
                        <span class="time">il y a 2 heures<span class="point"> . </span>3 min</span>
                    </a>

                </article>

                @endforeach

            </div>
        </div>

    </main>

@endsection
