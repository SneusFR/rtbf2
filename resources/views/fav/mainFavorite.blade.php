@extends('template.base')

@section('title')
    S'inscrire
@endsection

@section('content')
    <main class="{{$theme == 'Dark' ? 'dark-home-user' : 'home-user'}} container">

        <div class="wrapper">
            <div class="list-favs row">
                @if($favoritePosts->isEmpty())
                    <h3 class="text-center pt-5 ">Aucun article en favori pour le moment.</h3>
                @else
                    <h3 class="pb-4">Vos articles préférés :</h3>
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
                @endif
            </div>
        </div>
    </main>
@endsection

