@extends('template.base')

@section('title')
    Modifiez vos informations personnelles
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

            <div class="mon-profil d-flex">
                <img src="/img/user bleu.svg" alt="user">

                <section>
                    <h1>MON PROFIL</h1>
                    <h2>Gérer mes données personnelles</h2>
                </section>
            </div>

            <form action="" method="post" class="formulaire row align-items-center">

                @csrf

                <p><span class="etoile">*</span> Champs obligatoires</p>

                <div class="col-lg-6 col-12">
                    <label for="email">
                        Email <span class="etoile">*</span>
                    </label>
                    <br>
                    <input value="{{Auth::user()->email}}" readonly id="edit-email" name="email" type="email">
                </div>

                <div class="col-lg-6 col-12">
                    <label for="mdp">
                        Mot de passe <span class="etoile">*</span>
                    </label>

                    <section class="mdp col-12 m-0">
                        <a href="{{ route('edit.password') }}">
                            <button type="button" class="modif col-12"><img src="/img//modif bleu.svg"> Modifier</button>
                        </a>
                    </section>

                </div>

                <div class="col-lg-6 col-12">
                    <label for="prénom">
                        Prénom <span class="etoile">*</span>
                    </label>
                    <br>
                    <input value="{{Auth::user()->firstname_user}}" id="prénom" name="prénom" type="text">
                </div>

                <div class="col-lg-6 col-12">
                    <label for="nom">
                        Nom <span class="etoile">*</span>
                    </label>
                    <br>
                    <input value="{{Auth::user()->name_user}}" id="nom" name="nom" type="text">
                </div>

                <div class="col-lg-6 col-12">
                    <label for="adresse">
                        Adresse
                    </label>
                    <br>
                    <input value="{{Auth::user()->adresse_user}}" id="adresse" name="adresse" type="text">
                </div>

                <div class="col-lg-6 col-12">
                    <label for="cp">
                        Code Postal
                    </label>
                    <br>
                    <input value="{{Auth::user()->cp_user}}" id="cp" name="cp" type="number" min="1000">
                </div>

                <div class="col-lg-6 col-12">
                    <label for="ville">
                        Ville
                    </label>
                    <br>
                    <input value="{{Auth::user()->ville_user}}" id="ville" name="ville" type="text">
                </div>

                <div class="col-lg-6 col-12">
                    <label for="rôle">
                        rôle
                    </label>
                    <br>
                    <input value="{{Auth::user()->role_user}}" readonly id="edit-role" name="rôle" type="rôle">
                </div>


                <div class="col-lg-6 col-12">
                    <label for="jour">
                        Date de naissance <span class="etoile">*</span>
                    </label>
                    <br>

                    <div class="j-m-a row m-0 gap-2">

                        <section class="col-auto p-0">
                            <label class="" for="jour">jour</label>
                            <br>
                            <input placeholder="1" id="jour" type="number" min="1" max="31">
                        </section>

                        <section class="col-auto p-0">
                            <label for="mois">mois</label>
                            <br>
                            <input placeholder="1" id="mois" type="number" min="1" max="12">
                        </section>

                        <section class="col-auto p-0">
                            <label for="annee">année</label>
                            <br>
                            <input placeholder="1975" id="annee" type="number" min="1900" max="2023">
                        </section>

                    </div>

                </div>

                <div class="col-lg-6 col-12 row">

                    <section id="pref" class="p-0 pe-2 col-3">
                        <label for="pref">
                            Préfix
                        </label>
                        <br>
                        <select name="pref" id="pref">
                            <option value="+30">+30</option>
                            <option value="+32">+32</option>
                            <option value="+33">+33</option>
                            <option value="+43">+43</option>
                            <option value="+45">+45</option>
                            <option value="+49">+49</option>
                            <option value="+358">+358</option>
                            <option value="+372">+372</option>
                            <option value="+212">+212</option>
                            <option value="+213">+213</option>
                        </select>
                    </section>

                    <section class="p-0 col-9">
                        <label for="tel">Téléphone <span class="etoile">*</span></label>
                        <br>
                        <input value="{{Auth::user()->tel_user}}" id="tel" name="tel" type="tel">
                    </section>

                </div>

                <div class="col-lg-6 col-12">
                    <label for="genre"> Genre <span class="etoile">*</span></label>
                    <br>
                    <div class="d-flex align-items-center m-0">

                        @if(Auth::user()->genre_user == "homme")
                            <input class="genre" name="genre" value="homme" type="radio" checked>
                            <label class=" m-0" id="homme" for="homme"> Homme </label>

                            <input class="genre" name="genre"  value="femme" type="radio">
                            <label class="m-0" id="femme" for="femme"> Femme</label>
                        @else
                            <input class="genre" name="genre" value="homme" type="radio">
                            <label class=" m-0" id="homme" for="homme"> Homme </label>

                            <input class="genre" name="genre"  value="femme" type="radio" checked>
                            <label class="m-0" id="femme" for="femme"> Femme</label>
                        @endif

                    </div>

                </div>

                <div class="boutons-form d-flex justify-content-between">
                    <button class="valider">Valider</button>
                    <button class="supp">Supprimer mon compte</button>
                </div>

            </form>

        </div>

    </main>
@endauth
@guest()
    <div> Connectez vous d'abord !!!!</div>
@endguest

@endsection
