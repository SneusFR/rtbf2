@extends('base')

@section('title')
    S'inscrire
@endsection

@section('content')
    <main class="home-user container">

        <div class="wrapper">

            <div class="list-favs row">
    @foreach ($favoritePosts as $post)

                    <section class="col-lg-6 col-12">

                        <a href="article.html">
                            <button class="art-fav d-flex">
                                <p>
                                    {{$post->titleArt}}
                                </p>
                                <section class="">
                                    <img src="/img/arrow-sign.svg" alt="arrow-sign" class="arrow">
                                </section>

                            </button>
                        </a>
    @endforeach
@endsection
