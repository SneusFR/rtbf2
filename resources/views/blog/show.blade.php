@extends('base')

@section('content')
        <article>
            <h1> {{$post->title}}</h1>
            <p>
                {{$post->content}}
            </p>

            <img src="/img/{{$post->slug}}{{$post->id}}.jpg" alt="{{$post->title}}">

        </article>
@endsection
