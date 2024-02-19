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
                        <a class="art-fav d-flex" href="{{ route('blog.show', ['slug' => $post->slug, 'post' => $post->id]) }}">
                            <div class="col-10">
                                {{ $post->titleArt }}
                            </div>
                            <div class="col-2">
                                <img id="arrow" src="/img/arrow-sign.svg" alt="arrow-sign">
                            </div>
                        </a>
                    </section>
                @endforeach
            </div>

        </div>

@endsection

