@extends('base')

@section('title')
    Modifiez votre mot de passe
@endsection

@section('content')
    @auth()

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

                <form action="" method="post" class="formulaire mt-0">

                    @csrf

                    <section class="pb-4" style="margin: 0 auto; max-width: 300px;">
                        <label class="mb-0">Ancien mot de passe</label>
                        <input class="mb-2" id="old-password" name="old-password" type="password">

                        <label class="mb-0">Nouveau mot de passe</label>
                        <input class="mb-2" id="new-password" name="new-password" type="password">

                        <label class="mb-0">Confirmer nouveau mot de passe</label>
                        <input class="mb-2" id="new2-password" name="new2-password" type="password">
                    </section>

                    <div class="d-flex justify-content-center">
                        <button class="valider">Confirmer</button>
                    </div>

                </form>

            </div>

        </main>

    @endauth

@endsection

