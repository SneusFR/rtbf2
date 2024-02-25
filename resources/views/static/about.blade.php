@extends('template.base')

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

            <p>Ce site est une imitation du site de presse RTBF qui publie des news quotidiennes sur divers sujets. Le site est composé de fichiers dynamiques de 11 pages php :</p>
            <ul>
                <li>Une page d'accueil<span class="about-text">(/)</span></li>
                <li>Une page d'un article <span class="about-text">(/article/slug-id)</span></li>
                <li>Une page de login <span class="about-text">(/login)</span></li>
                <li>Une page d'inscription <span class="about-text">(/register)</span></li>
                <li>Une page de favoris <span class="about-text">(/favorite)</span></li>
                <li>Une page de recherche <span class="about-text">(/search)</span></li>
                <li>Une page à propos <span class="about-text">(/about)</span></li>
                <li>Une page de profile <span class="about-text">(/profile)</span></li>
                <li>Une page de modification d'identifiants <span class="about-text">(/edit)</span></li>
                <li>Une page de modification de mot de passe <span class="about-text">(/password)</span></li>
                <li>Une page de création d'article <span class="about-text">(/new)</span></li>
            </ul>

            <p>Il est aussi composé d'un fichier de mise en page (css) et un dossier qui contient les images. Ainsi que d'une base de donnée mysql</p>


            <p>Pour se connecter il faut se rendre sur le bonhomme en haut à droite de la navbar</p>

            <p>Pour se déconnecter il faut se rendre sur le bonhomme en haut à droite de la navbar et cliquer sur "se déconnecter"</p>


            <p>Pour mettre un article en favoris il faut être connecté et cliquer sur l'étoile au-dessus de l'article</p>

            <p>Pour voir ses favoris il faut être connecté et se rendre sur "mes favoris" se trouvant sur la navbar</p>

            <p>Pour retirer un article de ses favoris il faut recliquer sur l'étoile depuis l'index ou depuis l'article en question</p>

            <p>Pour modifier son profil utilisateur il faut se rendre sur le bonhomme en haut à droite de la navbar et cliquer sur "modifier mes info perso"</p>

            <p>Pour créer un article il faut être connecté en tant qu'admin et cliquer sur le bouton "publier" se trouvant sur la navbar</p>

            <p>Pour effectuer une recherche il faut se rendre sur l'icone loupe se trouvant en haut à droite de la navbar</p>

            <p>Pour s'inscrire il faut se rendre sur le bonhomme en haut à droite de la navbar et cliquer sur "s'inscrire"</p>











        </div>

    </main>

@endsection
