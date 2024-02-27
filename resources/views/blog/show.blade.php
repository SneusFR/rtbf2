@extends('template.base')

@section('title')
    {{$post->title_pos}}
@endsection

@section('content')

    <main class="{{$theme == 'Dark' ? 'dark-home-art' : 'home-art'}} container">

        <div class="{{$theme == 'Dark' ? 'dark-wrapper-art' : 'wrapper-art'}}">

            <div class="titre-art text-center">
                <h5>{{$post->cate_pos}}</h5>
                <h4><a href="article.html">{{$post->title_pos}}</a></h4>
            </div>

            <section class="">
                <form id="favoriteForm" action="" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{$post->id_pos}}">
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

                <img class="w-100" id={{$post->slug_pos}} src="/img/{{$post->slug_pos}}{{$post->id_pos}}.{{$post->ext_pos}}" alt={{$post->title_pos}}>
            </section>


            <p class="credit">© ISFCE – Stéphane Huguier</p>

            <div class="infos-art text-center">
                <section class="publier">
                    <span class="time">aujourd’hui à 02:00 - mise à jour il y a 11 minutes<span class="point"> . </span>5 min</span>
                </section>
                <section class="auteur">
                    <p>Par {{$post->aut_pos}}</p>
                </section>
            </div>


            <div class="stars">
                <i class="lar la-star" data-value="1"></i><i class="lar la-star" data-value="2"></i><i class="lar la-star" data-value="3"></i><i class="lar la-star" data-value="4"></i><i class="lar la-star" data-value="5"></i>
            </div>
            <input type="hidden" name="note" id="note" value="0">
            <script src="/js/main.js"></script>


            <div class="partager d-flex flex-wrap justify-content-center align-items-center gap-4">
                <p>PARTAGER</p>
                <a href="#"><img src="/img/facebook bleu.svg" alt="facebook"></a>
                <a href="#"><img src="/img/twitter bleu.svg" alt="twitter"></a>
                <a href="#"><img src="/img/whatsapp bleu.svg" alt="whatsapp"></a>
                <a href="#"><img src="/img/messenger bleu.svg" alt="messenger"></a>
                <a href="#"><img src="/img/linkedin bleu.svg" alt="linkedin"></a>
                <a href="#"><img src="/img/mail bleu.svg" alt="mail"></a>
            </div>

            <div class="{{$theme == 'Dark' ? 'dark-texte' : 'texte'}}">

                <p class="para-1 mt-0">{{$post->hook_pos}}</p>

                <p>{!! ($post->content_pos) !!}</p>

            </div>

            <div class="partager d-flex flex-wrap justify-content-center align-items-center gap-4">
                <p>PARTAGER</p>
                <a href="#"><img src="/img/facebook bleu.svg" alt="facebook"></a>
                <a href="#"><img src="/img/twitter bleu.svg" alt="twitter"></a>
                <a href="#"><img src="/img/whatsapp bleu.svg" alt="whatsapp"></a>
                <a href="#"><img src="/img/messenger bleu.svg" alt="messenger"></a>
                <a href="#"><img src="/img/linkedin bleu.svg" alt="linkedin"></a>
                <a href="#"><img src="/img/mail bleu.svg" alt="mail"></a>
            </div>

        </div>

    </main>
@endsection
