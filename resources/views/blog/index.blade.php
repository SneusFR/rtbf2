@extends('base')

@section('title')
    Acceuil
@endsection

@section('content')

    <main class="{{$theme == 'Dark' ? 'dark-home-index' : 'home-index'}} container">

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

        <div class="wrapper "> <!-- wrapper -->

            <section class="articles-une row">


                <article class="article-1 col-lg-9 col-12">

                    <h3>À LA UNE</h3>
                    <form id="favoriteForm" action="" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{$featuredPost->id}}">
                            @auth
                                @if($featuredPost->isFavoritedByUser(Auth::id()))
                                    <button type="submit" class="bouton-circulaire-fav">
                                        <img src="/img/star-filled.svg" alt="favorite" class="star">
                                    </button>
                                @else
                                <button type="submit" class="bouton-circulaire-nofav">
                                    <img src="/img/star-empty.png" alt="favorite" class="star">
                                </button>
                                @endif
                            @endauth
                            @guest
                            <button type="submit" class="bouton-circulaire-nofav">
                                    <img src="/img/star-empty.png" alt="favorite" class="star">
                            </button>

                            @endguest

                    </form>

                    <a href="{{route('blog.show', ['slug' => $featuredPost->slug, 'post' => $featuredPost->id]) }}"><img
                            src="/img/{{$featuredPost->slug}}{{$featuredPost->id}}.{{$featuredPost->extension}}"
                            width="100%" alt={{$featuredPost->title}}></a>

                    <footer class="under-une container">
                        <!-- ajoute la légère marge à gauche pour ressembler au site officiel-->
                        <h5>{{$featuredPost->categorie}}</h5>
                        <h4>
                            <a href="{{route('blog.show', ['slug' => $featuredPost->slug, 'post' => $featuredPost->id]) }}">{{$featuredPost->titleArt}}</a>
                        </h4>
                        <span class="time">il y a 1 heure<span class="point"> . </span>5 min</span>
                    </footer>
                </article>

                <div class="article-2-3 col-lg-3 col-12">

                    @foreach($rightSidePosts as $post)

                        <article class="article-2">

                            <form id="favoriteForm" action="" method="POST">
                                @csrf
                                <input type="hidden" name="post_id" value="{{$post->id}}">
                                @auth
                                    @if($post->isFavoritedByUser(Auth::id()))
                                        <button type="submit" class="bouton-circulaire-fav">
                                            <img src="/img/star-filled.svg" alt="favorite" class="star">
                                        </button>
                                    @else
                                        <button type="submit" class="bouton-circulaire-nofav">
                                            <img src="/img/star-empty.png" alt="favorite" class="star">
                                        </button>
                                    @endif
                                @endauth
                                @guest
                                    <button type="submit" class="bouton-circulaire-nofav">
                                        <img src="/img/star-empty.png" alt="favorite" class="star">
                                    </button>
                                @endguest
                            </form>

                            <a class="text-lg-start text-center d-flex flex-column align-items-center align-items-lg-start"
                               href="#">
                                <a href="{{route('blog.show', ['slug' => $post->slug, 'post' => $post->id]) }}"><img
                                        src="/img/{{$post->slug}}{{$post->id}}.{{$post->extension}}" width="100%"
                                        alt={{$post->title}}></a>
                                <h5>{{$post->categorie}}</h5>
                                <h4>{{$post->titleArt}}</h4>
                                <span class="time">il y a 60 minutes<span class="point"> . </span>2 min</span>
                            </a>
                        </article>

                    @endforeach
                </div>
            </section>

            <section class="articles-sec d-flex flex-lg-row flex-column align-items-center align-items-lg-start">

                @foreach($bottomPosts as $post)

                    <article class="article-4">


                        <form id="favoriteForm" action="" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                            @auth
                                @if($post->isFavoritedByUser(Auth::id()))
                                    <button type="submit" class="bouton-circulaire-fav">
                                        <img src="/img/star-filled.svg" alt="favorite" class="star">
                                    </button>
                                @else
                                    <button type="submit" class="bouton-circulaire-nofav">
                                        <img src="/img/star-empty.png" alt="favorite" class="star">
                                    </button>
                                @endif
                            @endauth

                            @guest
                                <button type="submit" class="bouton-circulaire-nofav">
                                    <img src="/img/star-empty.png" alt="favorite" class="star">
                                </button>
                            @endguest
                        </form>

                        <a href="{{route('blog.show', ['slug' => $post->slug, 'post' => $post->id]) }}">
                            <img src="/img/{{$post->slug}}{{$post->id}}.{{$post->extension}}" alt="{{$post->title}}">
                            <h5>{{$post->categorie}}</h5>
                            <h4>{{$post->titleArt}}</h4>
                            <span class="time">il y a 2 heures<span class="point"> . </span>3 min</span>
                        </a>
                    </article>

                @endforeach


            </section>
        </div>
    </main>

@endsection
