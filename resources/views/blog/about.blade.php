@extends('base')

@section('title')
    Á Propos
@endsection

@section('content')

    <main class="{{$theme == 'Dark' ? 'dark-home-user' : 'home-user'}} container">

        <div class="wrapper">

            <h1>Livrable 1:</h1>

            <p>Ce site est une imitation du site de presse RTBF qui publie des news quotidiennes sur divers sujets. Le site est composé de fichiers statiques de 6 pages html :</p>
            <ul>
                <li>Une page d'accueil (index.html)</li>
                <li>Une page d'un article (article.html)</li>
                <li>Une page de login (user.html)</li>
                <li>Une page de favoris (favs.html)</li>
                <li>Une page de recherche (search.html)</li>
                <li>Une page à propos (about.html)</li>
            </ul>

            <p>Il est aussi composé d'un fichier de mise en page (css) et un dossier qui contient les images.</p>

            <p>Pour mettre en favoris un article, il faut cliquer sur l'étoile en haut à gauche de l'article. Et pour accéder aux articles favoris, il faut se rendre dans l'onglet "mon choix" tout en haut de la navbar.</p>

            <p>Pour effectuer une recherche, il faut cliquer sur l'icône loupe en haut à droite de la navbar pour être redirigé sur une page permettant de rechercher les articles qu'on souhaite.</p>

            <p>L'onglet à propos se trouve lui aussi tout en haut de la navbar.</p>

            <h2>DATE DU LIVRABLE 14/12/23</h2>

            <h1>Livrable 2:</h1>

        </div>

    </main>

@endsection
