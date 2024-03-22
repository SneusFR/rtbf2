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

        <div class="wrapper ">

            <h1 class="h1log">Se connecter via Burotix</h1>

            <div class="d-flex justify-content-center pt-3">
                <div class="col-6">

                    <form action="" method="post" class="vstack gap-3 ">

                        @csrf

                        <div class="form-group">
                            <label for="login">Login</label>
                            <input type="text" class="form-control" id="login" name="login">
                        </div>

                        <div class="form-group mb-3" >
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <button class="btn-API" style="padding-bottom:27px"> Se connecter via Burotix </button>

                    </form>
                </div>
            </div>

        </div>
    </main>
@endsection
