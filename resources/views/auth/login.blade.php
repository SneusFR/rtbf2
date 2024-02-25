@extends('template.base')

@section('title')
    Login
@endsection


@section("content")

    <main class="{{$theme == 'Dark' ? 'dark-home-user' : 'home-user'}} container">

        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>


            @elseif(session('fail'))
                <div class="alert alert-danger">
                    {{session('fail')}}
                </div>
            @endif
        </div>

        <div class="wrapper">

           <h1 class="h1log">Se connecter</h1>
            <div class="card-body">
               <form action="" method="post" class="vstack gap-3">

                   @csrf

                   <div class="form-group">
                       <label for="email">Email</label>
                       <input type="email" class="form-control" id="email" name="email" value="{{ old('email')}}">
                       @error("email")
                       {{$message}}
                       @enderror
                   </div>

                   <div class="form-group">
                       <label for="password">Mot de passe</label>
                       <input type="password" class="form-control" id="password" name="password">
                       @error("password")
                       {{$message}}
                       @enderror
                   </div>

                   <button class="btn btn-primary mt-1" style="padding-bottom:27px"> Se connecter </button>

                   <a class="btn-reg" href={{route('auth.register')}}>S'inscrire</a>


               </form>
            </div>
        </div>
    </main>
@endsection
