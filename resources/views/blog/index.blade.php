@extends('template.base')

@section('title')
    Acceuil
@endsection

@section('content')

    <script src="/js/favoris.js"></script>
    <script src="/js/details.js"></script>

    <main class="{{$theme == 'Dark' ? 'dark-home-index' : 'home-index'}} container" data-role="{{ Auth::check() ? Auth::user()->role_user : 'invite' }}">

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

            <div id="notification">
            </div>

                <div id="details" class="row {{$theme == 'Dark' ? 'bg-dark bg-gradient text-white' : ' bg-gradient text-dark'}}" >
                    <section class="d-flex">
                        <span>ID : </span><p id="idText"></p>
                    </section>

                    <section class="d-flex">
                        <span>Created at : </span><p id="createdAtText"></p>
                    </section>

                    <section class="d-flex">
                        <span>Readtime : </span><p id="readtimeText"></p>
                    </section>

                    <section class="d-flex">
                        <span>Category : </span><p id="cateText"></p>
                    </section>

                    <section class="d-flex">
                        <span>Length : </span><p id="lengthText"></p>
                    </section>

                    <section class="d-flex">
                        <span>Role : </span><p id="roleText"></p>
                    </section>
                </div>

        </div>

        <div class="wrapper "> <!-- wrapper -->

            <div id="favWindow">
                <div id="favWindowWrapper">

                </div>
            </div>

            <section class="articles-une row">

                <a href="{{$publicite['banner_4IPDW']['link']}}" target="_blank">
                    <div class="publicite d-flex mt-3 mb-2">
                        <p class="p-2">{{$publicite['banner_4IPDW']['text']}}</p>
                        <img src='{{$publicite['banner_4IPDW']['image']}}'>
                    </div>
                </a>

                <div>
                    <input type="radio" id="jqueryChoice" name="choice" value="jquery" checked data-role="{{ Auth::check() ? Auth::user()->role_user : 'invite' }}">
                    <label for="jqueryChoice">jQuery</label>
                    <input type="radio" id="formChoice" name="choice" value="form">
                    <label for="formChoice">Form</label>
                </div>

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
                    <form id="favoriteForm" action="" method="POST">

                    <input type="hidden" name="post_id" value="{{$featuredPost->id_pos}}">
                        @csrf
                            @auth
                                @if($featuredPost->isFavoritedByUser(Auth::id()))
                                    <button id="{{$featuredPost->id_pos}}" type="button" class="bouton-circulaire-fav" data-ajouter-fav-url="{{ route('blog.ajouter.fav', ['slug' => $featuredPost->slug_pos, 'post' => $featuredPost->id_pos]) }}" data-post-id="{{ $featuredPost->id_pos }}">
                                        <img src="/img/star-filled.svg" alt="favorite" class="star">
                                    </button>
                                @else
                                <button id="{{$featuredPost->id_pos}}" type="button" class="bouton-circulaire-nofav" data-ajouter-fav-url="{{ route('blog.ajouter.fav', ['slug' => $featuredPost->slug_pos, 'post' => $featuredPost->id_pos]) }}" data-post-id="{{ $featuredPost->id_pos }}">
                                    <img src="/img/star-empty.png" alt="favorite" class="star">
                                </button>
                                @endif
                            @endauth
                            @guest
                                <button type="button" class="bouton-circulaire-nofav">
                                        <img src="/img/star-empty.png" alt="favorite" class="star">
                                </button>
                            @endguest
                    </form>

                    <a href="{{route('blog.show', ['slug' => $featuredPost->slug_pos, 'post' => $featuredPost->id_pos]) }}"><img
                            src="/img/{{$featuredPost->ext_pos}}"
                            width="100%" alt={{$featuredPost->title_pos}}></a>

                    <footer class="under-une container">
                        <!-- ajoute la légère marge à gauche pour ressembler au site officiel-->
                        <h5>{{$featuredPost->cate_pos}}</h5>
                        <h4 class="title" data-id="{{ $featuredPost->id_pos }}" data-slug="{{ $featuredPost->slug_pos }}" data-cate="{{ $featuredPost->cate_pos }}" data-readtime="{{ $featuredPost->readtime_pos }}" data-create="{{ $featuredPost->created_at }}" data-length="{{$featuredPost->length_pos}}" data-role="{{ Auth::check() ? Auth::user()->role_user : 'guest' }}">
                            <a href="{{route('blog.show', ['slug' => $featuredPost->slug_pos, 'post' => $featuredPost->id_pos]) }}">{{$featuredPost->title_pos}}</a>
                        </h4>
                        <span class="time">il y a 1 heure<span class="point"> . </span>5 min</span>
                    </footer>
                </article>

                <div class="article-2-3 col-lg-3 col-12">


                @foreach($rightSidePosts as $post)

                        <article class="article-2">

                            <div id="formContainer">

                                <form id="favoriteForm" action="" method="POST">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{$post->id_pos}}">
                                    @auth
                                        @if($post->isFavoritedByUser(Auth::id()))
                                            <button id="{{$post->id_pos}}" type="button" class="bouton-circulaire-fav" data-ajouter-fav-url="{{ route('blog.ajouter.fav', ['slug' => $post->slug_pos, 'post' => $post->id_pos]) }}" data-post-id="{{ $post->id_pos }}">
                                                <img src="/img/star-filled.svg" alt="favorite" class="star">
                                            </button>
                                        @else
                                            <button id="{{$post->id_pos}}" type="button" class="bouton-circulaire-nofav" data-ajouter-fav-url="{{ route('blog.ajouter.fav', ['slug' => $post->slug_pos, 'post' => $post->id_pos]) }}" data-post-id="{{ $post->id_pos }}">
                                                <img src="/img/star-empty.png" alt="favorite" class="star">
                                            </button>
                                        @endif
                                    @endauth
                                    @guest
                                        <button type="button" class="bouton-circulaire-nofav" data-ajouter-fav-url="{{ route('blog.ajouter.fav', ['slug' => $post->slug_pos, 'post' => $post->id_pos]) }}" data-post-id="{{ $post->id_pos }}">
                                            <img src="/img/star-empty.png" alt="favorite" class="star">
                                        </button>
                                    @endguest
                                </form>
                            </div>


                            <a class="text-lg-start text-center d-flex flex-column align-items-center align-items-lg-start"
                               href="#">
                                <a href="{{route('blog.show', ['slug' => $post->slug_pos, 'post' => $post->id_pos]) }}"><img
                                        src="/img/{{$post->ext_pos}}" width="100%"
                                        alt={{$post->title_pos}}>
                                        <h5>{{$post->cate_pos}}</h5>
                                        <h4 class="title" data-id="{{ $post->id_pos }}" data-slug="{{ $post->slug_pos }}" data-cate="{{ $post->cate_pos }}" data-readtime="{{ $post->readtime_pos }}" data-create="{{ $post->created_at }}" data-length="{{$post->length_pos}}" data-role="{{ Auth::check() ? Auth::user()->role_user : 'guest' }}">{{$post->title_pos}}</h4>
                                </a>

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
                            <input type="hidden" name="post_id" value="{{$post->id_pos}}">
                            @auth
                                @if($post->isFavoritedByUser(Auth::id()))
                                    <button id="{{$post->id_pos}}" type="button" class="bouton-circulaire-fav" data-ajouter-fav-url="{{ route('blog.ajouter.fav', ['slug' => $post->slug_pos, 'post' => $post->id_pos]) }}" data-post-id="{{ $post->id_pos }}">
                                        <img src="/img/star-filled.svg" alt="favorite" class="star">
                                    </button>
                                @else
                                    <button id="{{$post->id_pos}}" type="button" class="bouton-circulaire-nofav" data-ajouter-fav-url="{{ route('blog.ajouter.fav', ['slug' => $post->slug_pos, 'post' => $post->id_pos]) }}" data-post-id="{{ $post->id_pos }}">
                                        <img src="/img/star-empty.png" alt="favorite" class="star">
                                    </button>
                                @endif
                            @endauth
                            @guest
                                <button id="{{$post->id_pos}}" type="button" class="bouton-circulaire-nofav"data-ajouter-fav-url="{{ route('blog.ajouter.fav', ['slug' => $post->slug_pos, 'post' => $post->id_pos]) }}" data-post-id="{{ $post->id_pos }}">
                                    <img src="/img/star-empty.png" alt="favorite" class="star">
                                </button>
                            @endguest

                        </form>

                        <a href="{{route('blog.show', ['slug' => $post->slug_pos, 'post' => $post->id_pos]) }}">
                            <img src="/img/{{$post->ext_pos}}" alt="{{$post->title_pos}}">
                            <h5>{{$post->cate_pos}}</h5>
                            <h4 class="title" data-id="{{ $post->id_pos }}" data-slug="{{ $post->slug_pos }}" data-cate="{{ $post->cate_pos }}" data-readtime="{{ $post->readtime_pos }}" data-create="{{ $post->created_at }}" data-length="{{$post->length_pos}}">{{$post->title_pos}}</h4>

                            <span class="time">il y a 2 heures<span class="point"> . </span>3 min</span>
                        </a>

                    </article>
                @endforeach

            </section>
        </div>
    </main>

@endsection
