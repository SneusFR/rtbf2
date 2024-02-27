@extends('template.base')

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

            @if($query==null)

                <div class="d-flex justify-content-center py-5">
                    <img src="/img/NoSearchImg.svg" id="noresult" alt="Aucun résultat">
                </div>

            @else

                <div class="py-5">
                    @foreach($posts as $post)
                        <a href="{{route('blog.show', ['slug' => $post->slug_pos, 'post' => $post->id_pos]) }}">

                            <article class="{{$theme == 'Dark' ? 'dark-article-search' : 'article-search'}}">

                                <h5>{{$post->cate_pos}}</h5>
                                <h4>{{$post->title_pos}}</h4>
                                <span class="time">il y a 2 heures<span class="point"> . </span>3 min</span>

                            </article>
                        </a>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center">
                    {{$posts->appends(['query' => $query])->onEachSide(1)->links()}}
                </div>
            @endif
        </div>
    </main>

@endsection
