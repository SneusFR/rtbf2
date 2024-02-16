@extends('base')

@section('title')
    Login
@endsection


@section("content")

    <main class="home-user container">

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

           <h1>Se connecter</h1>
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
                       <label for="password">password</label>
                       <input type="password" class="form-control" id="password" name="password">
                       @error("password")
                       {{$message}}
                       @enderror
                   </div>

                   <button class="btn btn-primary"> Se connecter </button>

                   <a href={{route('auth.register')}}>S'inscrire</a>


               </form>
            </div>
        </div>
    </main>
@endsection
