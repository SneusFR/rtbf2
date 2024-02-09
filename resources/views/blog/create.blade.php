@extends('base')

@section('content')
    <form action="" method="post">
        @csrf
        <div>
            <input type="text" name="title" value={{old('title',"Titre")}}>
            @error("title")
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
