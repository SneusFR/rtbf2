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

            <h2>DATE DU LIVRABLE 14/12/23</h2><br>

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
                <li>Une page de météo lié à l'API d'un centre de météorologie <span class="about-text">(/meteo)</span></li>
                <li>Une page d'édition d'article <span class="about-text">(edit/article/slug-id)</span></li>

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

            <p>Pour éditer un article il faut être admin et aller sur la page de l'article et cliquer sur le petit bouton en haut à droite de l'image de l'article</p>

            <p>Il y a la possibilité de passer en DarkMode en cliquant sur la lune en haut à gauche de la navbar (toutes les pages sont "DarkMode Friendly")</p>

            <p>Il y a la possibilité de consulter les données météorologiques des 4 prochains jours en laissant son curseur sur le bouton météo en haut à droite de la navbar</p>

            <h2>DATE DU LIVRABLE 11/03/2024</h2><br>


            <h1>Livrable 3:</h1>

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
                <li>Une page de météo lié à l'API d'un centre de météorologie <span class="about-text">(/meteo)</span></li>
                <li>Une page d'édition d'article <span class="about-text">(edit/article/slug-id)</span></li>
                <li>Une page de connexion pour se connecter via burotix <span class="about-text">(/loginAPI)</span></li>
            </ul>

           <h2>Justifications</h2>

            <h4>Connexion via l'API</h4>

            <p>Nous avons décidé de garder notre ancien moyen de connexion mais de rajouter la possibilité de se connecter via l'API</p>
            <p> Pour se faire il faut se rendre dans la page de connexion et cliquer sur "se connecter via Burotix"</p>
            <p>Nous avons dû aussi rajouter lors de la première connexion d'un utilisateur se trouvant sur l'API de l'insérer dans notre table USER</p>
            <p>Car sans ça il n'aurait pas pu accéder à ses favoris et d'autres informations (adresse, téléphone, mail etc...) auraient manqué</p>
            <p>L'insertion d'un utilisateur de l'API dans la DB ne se fait qu'une seule et unique fois (voir controller login pour + d'info) </p>

            <h4>Recherche d'article</h4>
            <p>Pour la recherche d'article nous avons décidé de mettre en place une pagination. 10 articles par page seront affichés</p>
            <p>S'il y'en a plus il vous suffira d'aller en bas de la page et de cliquer sur un numéro pour afficher une autre page</p>
            <p> On a décidé que l'ordre de pertinence serait de prendre l'article le plus récent de la DB au moins récent</p>
            <p> Pour les articles sans image une image par défaut sera proposé</p>


            <h2>Ajout par rapport au livrable 2</h2>

            <p> Le seul ajout est la possibilité de se connecter via l'API. Tout le reste des consignes avaient déjà été réalisé
            lors du livrable 2. Référez-vous donc principalement au livrable 2 pour naviguer sur le site</p>
            <h2>DATE DU LIVRABLE 24/03/2024</h2><br>

        </div>

    </main>

@endsection
