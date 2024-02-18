@extends('base')

@section('title')
    {{$post->titleArt}}
@endsection

@section('content')

    <main class="home-art container">

        <div class="wrapper-art">

            <div class="titre-art text-center">
                <h5>{{$post->categorie}}</h5>
                <h4><a href="article.html">{{$post->titleArt}}</a></h4>
            </div>

            <section>
                <button class="bouton-circulaire"> <img src="/img/star-empty.png" alt="favorite" class="star"></button>

                <img class="w-100" id={{$post->slug}} src="/img/{{$post->slug}}{{$post->id}}.{{$post->extension}}" alt={{$post->title}}>
            </section>


            <p class="credit">© ISFCE – Stéphane Huguier</p>

            <div class="infos-art text-center">
                <section class="publier">
                    <span class="time">aujourd’hui à 02:00 - mise à jour il y a 11 minutes<span class="point"> . </span>5 min</span>
                </section>
                <section class="auteur">
                    <p>Par {{$post->auteur}}</p>
                </section>
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

            <div class="texte">

                <p class="para-1 mt-0">{{$post->hook}}</p>

                <p>{{$post->content}}</p>

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
