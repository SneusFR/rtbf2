@extends('template.base')

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

                <a href="{{$publicite['banner_4IPDW']['link']}}" target="_blank">
                    <div class="publicite d-flex mt-3 mb-2">
                        <p class="p-2">{{$publicite['banner_4IPDW']['text']}}</p>
                        <img src='{{$publicite['banner_4IPDW']['image']}}'>
                    </div>
                </a>

                <style>
                    /*PUBLICITE*/

                    .publicite {
                        border-style: groove;
                        border-radius: 12px;
                        border-color: #c9e7f9;
                        overflow: hidden;
                        background-image: url({{ $publicite['banner_4IPDW']['background_image'] }});
                        color: {{ $publicite['banner_4IPDW']['color'] }};
                    }

                    .publicite:hover {
                        transform: scale(1.05);
                        box-shadow: 0px 5px 8px rgba(0, 0, 0, 0.3);
                    }
                </style>

                <article class="article-1 col-lg-9 col-12">

                    <h3>À LA UNE</h3>
                        <input type="hidden" name="post_id" value="{{$featuredPost->id_pos}}">
                            @auth
                                @if($featuredPost->isFavoritedByUser(Auth::id()))
                                    <button type="submit" class="bouton-circulaire-fav" data-ajouter-fav-url="{{ route('blog.ajouter.fav', ['slug' => $featuredPost->slug_pos, 'post' => $featuredPost->id_pos]) }}" data-post-id="{{ $featuredPost->id_pos }}">
                                        <img src="/img/star-filled.svg" alt="favorite" class="star">
                                    </button>
                                @else
                                <button type="submit" class="bouton-circulaire-nofav" data-ajouter-fav-url="{{ route('blog.ajouter.fav', ['slug' => $featuredPost->slug_pos, 'post' => $featuredPost->id_pos]) }}" data-post-id="{{ $featuredPost->id_pos }}">
                                    <img src="/img/star-empty.png" alt="favorite" class="star">
                                </button>
                                @endif
                            @endauth
                            @guest
                                <button type="submit" class="bouton-circulaire-nofav">
                                        <img src="/img/star-empty.png" alt="favorite" class="star">
                                </button>
                            @endguest

                    <a href="{{route('blog.show', ['slug' => $featuredPost->slug_pos, 'post' => $featuredPost->id_pos]) }}"><img
                            src="/img/{{$featuredPost->ext_pos}}"
                            width="100%" alt={{$featuredPost->title_pos}}></a>

                    <footer class="under-une container">
                        <!-- ajoute la légère marge à gauche pour ressembler au site officiel-->
                        <h5>{{$featuredPost->cate_pos}}</h5>
                        <h4>
                            <a href="{{route('blog.show', ['slug' => $featuredPost->slug_pos, 'post' => $featuredPost->id_pos]) }}">{{$featuredPost->title_pos}}</a>
                        </h4>
                        <span class="time">il y a 1 heure<span class="point"> . </span>5 min</span>
                    </footer>
                </article>

                <div class="article-2-3 col-lg-3 col-12">

                    <script src="/js/favoris.js"></script>


                    @foreach($rightSidePosts as $post)
                        <article class="article-2">
                            <input type="hidden" name="post_id" value="{{$post->id_pos}}">
                            @auth
                                @if($post->isFavoritedByUser(Auth::id()))
                                    <button type="submit" class="bouton-circulaire-fav" data-ajouter-fav-url="{{ route('blog.ajouter.fav', ['slug' => $post->slug_pos, 'post' => $post->id_pos]) }}" data-post-id="{{ $post->id_pos }}">
                                        <img src="/img/star-filled.svg" alt="favorite" class="star">
                                    </button>
                                @else
                                    <button type="submit" class="bouton-circulaire-nofav" data-ajouter-fav-url="{{ route('blog.ajouter.fav', ['slug' => $post->slug_pos, 'post' => $post->id_pos]) }}" data-post-id="{{ $post->id_pos }}">
                                        <img src="/img/star-empty.png" alt="favorite" class="star">
                                    </button>
                                @endif
                            @endauth
                            @guest
                                <button type="submit" class="bouton-circulaire-nofav" data-ajouter-fav-url="{{ route('blog.ajouter.fav', ['slug' => $post->slug_pos, 'post' => $post->id_pos]) }}" data-post-id="{{ $post->id_pos }}">
                                    <img src="/img/star-empty.png" alt="favorite" class="star">
                                </button>
                            @endguest


                            <a class="text-lg-start text-center d-flex flex-column align-items-center align-items-lg-start"
                               href="#">
                                <a href="{{route('blog.show', ['slug' => $post->slug_pos, 'post' => $post->id_pos]) }}"><img
                                        src="/img/{{$post->ext_pos}}" width="100%"
                                        alt={{$post->title_pos}}></a>
                                <h5>{{$post->cate_pos}}</h5>
                                <h4>{{$post->title_pos}}</h4>
                                <span class="time">il y a 60 minutes<span class="point"> . </span>2 min</span>
                            </a>
                        </article>

                    @endforeach
                </div>
            </section>

            <section class="articles-sec d-flex flex-lg-row flex-column align-items-center align-items-lg-start">

                @foreach($bottomPosts as $post)

                    <article class="article-4">
                            <input type="hidden" name="post_id" value="{{$post->id_pos}}">
                            @auth
                                @if($post->isFavoritedByUser(Auth::id()))
                                    <button type="submit" class="bouton-circulaire-fav" data-ajouter-fav-url="{{ route('blog.ajouter.fav', ['slug' => $post->slug_pos, 'post' => $post->id_pos]) }}" data-post-id="{{ $post->id_pos }}">
                                        <img src="/img/star-filled.svg" alt="favorite" class="star">
                                    </button>
                                @else
                                    <button type="submit" class="bouton-circulaire-nofav" data-ajouter-fav-url="{{ route('blog.ajouter.fav', ['slug' => $post->slug_pos, 'post' => $post->id_pos]) }}" data-post-id="{{ $post->id_pos }}">
                                        <img src="/img/star-empty.png" alt="favorite" class="star">
                                    </button>
                                @endif
                            @endauth
                            @guest
                                <button type="submit" class="bouton-circulaire-nofav"data-ajouter-fav-url="{{ route('blog.ajouter.fav', ['slug' => $post->slug_pos, 'post' => $post->id_pos]) }}" data-post-id="{{ $post->id_pos }}">
                                    <img src="/img/star-empty.png" alt="favorite" class="star">
                                </button>
                            @endguest

                        <a href="{{route('blog.show', ['slug' => $post->slug_pos, 'post' => $post->id_pos]) }}">
                            <img src="/img/{{$post->ext_pos}}" alt="{{$post->title_pos}}">
                            <h5>{{$post->cate_pos}}</h5>
                            <h4>{{$post->title_pos}}</h4>
                            <span class="time">il y a 2 heures<span class="point"> . </span>3 min</span>
                        </a>

                    </article>
                @endforeach

            </section>
        </div>
    </main>

@endsection
