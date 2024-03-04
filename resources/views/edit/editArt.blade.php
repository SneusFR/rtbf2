@extends('template.base')

@section('content')

    <main class="{{$theme == 'Dark' ? 'dark-home-art' : 'home-art'}} container">

        <div class="wrapper-art">

            <form action="" method="post" class="{{$theme == 'Dark' ? 'dark-form-crea' : 'form-crea'}} vstack gap-2" enctype="multipart/form-data">
                @csrf
                <div class="crea-img">
                    <input id="file-upload-button" type="file" name="image">
                    @error("image")
                    {{$message}}
                    @enderror
                </div>
                <div class="crea-cate">
                    <select name="cate_pos" class="crea-cate">
                        <option>MONDE</option>
                        <option>POLITIQUE</option>
                        <option>SPORT</option>
                        <option>DIVERTISSEMENT</option>
                        <option>IXPÉ</option>
                        <option>HISTOIRE</option>
                        <option>FOOTBALL</option>
                        <option>NBA</option>
                        <option>DIVERS</option>
                    </select>
                </div>
                <div>
                    <input class="crea-titre" type="text" name="title_pos" value="{{ old('titleArt', $post->title_pos ?? '') }}">
                    @error("title_pos")
                    {{$message}}
                    @enderror
                </div>

                <div class="crea-hook">
                    <textarea class="crea-hook" name="hook_pos">{{ old('hook', $post->hook_pos ?? '') }}</textarea>
                    @error("hook")
                    {{$message}}
                    @enderror
                </div>

                <div class="crea-content">
                    <textarea class="crea-content" name="content_pos">{{ old('content', $post->content_pos ?? '') }}</textarea>
                    @error("content")
                    {{$message}}
                    @enderror
                </div>

                {{Auth::user()->name_pos.' '.Auth::user()->firstname_pos}}

                <button class="btn btn-reg"> editer article</button>
            </form>
        </div>
    </main>

@endsection
