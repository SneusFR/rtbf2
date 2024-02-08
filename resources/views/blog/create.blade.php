@extends('base')

@section('content')
    <form action="" method="post">
        @csrf
        <input type="text" name="title" value="Article de demo">
        <textarea name="content"> Contenu de démonstration</textarea>
        <button>Enregistrer</button>
    </form>


@endsection
