@extends('base')


@section('content')

    <main class="home-index container">

        <div class="wrapper "> <!-- wrapper -->

            @foreach($posts as $post)
                @if($post->Breaking)

                    <section class="articles-une row">

                        <article class="article-1 col-lg-9 col-12">
                            <h3>À LA UNE</h3>

                            <button class="bouton-circulaire"> <img src="/img/star-empty.png" alt="favorite" class="star"></button>

                            <a href="{{route('blog.show', ['slug' => $post->slug, 'post' => $post->id]) }}"><img src="/img/{{$post->slug}}{{$post->id}}.jpg" width="100%" alt="article 1"></a>

                            <footer class="under-une container"> <!-- ajoute la légère marge à gauche pour ressembler au site officiel-->
                                <h5>économie</h5>
                                <h4><a href="{{route('blog.show', ['slug' => $post->slug, 'post' => $post->id]) }}">{{$post->titleArt}}</a></h4>
                                <span class="time">il y a 1 heure<span class="point"> . </span>5 min</span>
                            </footer>
                        </article>
    @endif
    @endforeach


                        <div class="article-2-3 col-lg-3 col-12">

                            @foreach($posts as $post)
                                @if($post->rightSide)

                            <article class="article-2">

                                <button class="bouton-circulaire"> <img src="/img/star-empty.png" alt="favorite" class="star"></button>

                                <a class="text-lg-start text-center d-flex flex-column align-items-center align-items-lg-start" href="#">
                                    <img src="/img/{{$post->slug}}{{$post->id}}.jpeg" alt="{{$post->title}}">
                                    <h5>monde</h5>
                                    <h4>{{$post->titleArt}}</h4>
                                    <span class="time">il y a 60 minutes<span class="point"> . </span>2 min</span>
                                </a>
                            </article>
                            @endif
                            @endforeach
                        </div>
                    </section>





                    <section class="articles-sec d-flex flex-lg-row flex-column align-items-center align-items-lg-start">

                        <article class="article-4">

                            <button class="bouton-circulaire"> <img src="/img/star-empty.png" alt="favorite" class="star"></button>

                            <a href="#">
                                <img src="/img/article-4.jpg" alt="article 4">
                                <h5>football belge</h5>
                                <h4>Charles De Ketelaere : "je suis là pour aider l’équipe et prendre de la confiance"</h4>
                                <span class="time">il y a 2 heures<span class="point"> . </span>3 min</span>
                            </a>
                        </article>

                        <article class="article-5">

                            <button class="bouton-circulaire"> <img src="/img/star-empty.png" alt="favorite" class="star"></button>

                            <a href="#">
                                <img src="/img/article-5.jpg" alt="article 5">
                                <h5>éducation</h5>
                                <h4>CEB : "Il nous faut deux ans pour concevoir un examen de A à Z"</h4>
                                <span class="time">il y a 4 heures<span class="point"> . </span>2 min</span>
                            </a>
                        </article>

                        <article class="article-6">
                            <button class="bouton-circulaire"> <img src="/img/star-empty.png" alt="favorite" class="star"></button>

                            <a href="#">
                                <img src="/img/article-6.jpg" alt="article 6">
                                <h5>ixpé</h5>
                                <h4>Destiny 2 : le studio vole un artwork mais présente ses excuses par après</h4>
                                <span class="time">il y a 3 heures<span class="point"> . </span>1 min</span>
                            </a>
                        </article>

                        <article class="article-7">
                            <button class="bouton-circulaire"> <img src="/img/star-empty.png" alt="favorite" class="star"></button>

                            <a href="#">
                                <img src="/img/article-7.jpg" alt="article 7">
                                <h5>justice</h5>
                                <h4>Royaume-Uni : Benjamin Mendy va être rejugé pour viol et tentative de viol</h4>
                                <span class="time">hier à 22:36<span class="point"> . </span>2 min</span>
                            </a>
                        </article>
                    </section>
        </div>
    </main>




@endsection
