@extends('base')

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
                <div>
                    <input class="crea-titre" type="text" name="title" value={{old('title',"Titre")}}>
                    @error("title")
                    {{$message}}
                    @enderror
                </div>
                <div class="crea-cate">
                    <select name="categorie" class="crea-cate">
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
                    <input class="crea-titre" type="text" name="titleArt" value={{old('titleArt',"titreArt")}}>
                    @error("titleArt")
                    {{$message}}
                    @enderror
                </div>

                <div class="crea-hook">
                    <textarea  class="crea-hook" name="hook"> {{old('hook',"hook")}}</textarea>
                    @error("hook")
                    {{$message}}
                    @enderror
                </div>

                <div class="crea-content">
                    <textarea class="crea-content" name="content"> {{old('content', 'mon contenue')}}</textarea>
                    @error("content")
                    {{$message}}
                    @enderror
                </div>
                <div>
                    {{Auth::user()->name.' '.Auth::user()->firstname}}
                </div>
                <button class="btn btn-reg">Publier article</button>
            </form>
        </div>
    </main>

@endsection
