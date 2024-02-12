@extends('base')

@section('content')
    <form action="" method="post" class="vstack gap-2" enctype="multipart/form-data">
        @csrf
        <div>
            <input type="file" name="image">
            @error("image")
                {{$message}}
            @enderror
        </div>
        <div>
            <input type="text" name="title" value={{old('title',"Titre")}}>
            @error("title")
            {{$message}}
            @enderror
        </div>
        <div>
            <input type="text" name="titleArt" value={{old('titleArt',"Titre article")}}>
            @error("titleArt")
            {{$message}}
            @enderror
        </div>
        <div>
            <textarea name="content"> {{old('content', 'mon contenue')}}</textarea>
            @error("content")
            {{$message}}
            @enderror
        </div>
        <button>Enregistrer</button>
    </form>


@endsection
