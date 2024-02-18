@php use Illuminate\Support\Facades\Auth; @endphp
    <!doctype html>
<html lang="fr">
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RTBF.be - La référence de l'actualité belge et internationale - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/main.css">
    <script src="/js/main.js"></script>


</head>
<body>

<header class="header-rtbf">
    <nav class="navigation">
        <div class="container">

            <section class="nav-top d-flex align-items-center justify-content-between flex-wrap">

                <select id="mode" name="mode">
                    <option>Dark mode</option>
                    <option>Light mode</option>
                </select>

                <div class=" nav-top-left d-flex justify-content-center col-lg-8 col-12 flex-wrap">
                    <a href={{route('blog.index')}}><img class="logo" src="/img/RTBF.svg" alt="Logo"></a>
                    @foreach($menus as $menu)
                        @if($menu->firstNav)
                            <a class="nav-title" href="{{route($menu->routes)}}">{{$menu->title}}</a>
                        @endif
                    @endforeach
                    @Auth
                    @if (Auth::user()->rôle == "Admin")
                        <a class="nav-title" href="{{route('blog.create')}}">Publier</a>
                    @endif
                    @endauth
                </div>
                <div class="nav-top-right d-flex justify-content-center col-lg-2 col-12">
                    <a href={{route('blog.search')}}><img src="/img/search.svg" alt="recherche"></a>
                    <a href="#"><img src="/img/sun.svg" alt="météo"></a>

                    @guest()
                        <a href={{route('auth.login')}}><img src="/img/user.svg" alt="user"></a>
                    @endguest
                    @auth()
                        <a href={{route('profile.profile')}}><img src="/img/user.svg" alt="user"></a>
                        <div class="test"> {{Auth::user()->name.' '.Auth::user()->firstname}}</div>
                    @endauth

                </div>
            </section>

            <section class="nav-bot">
                <a class="menu" href="#">menu</a>
                @foreach($menus as $menu)
                    @if($menu->secondNav)
                        <a class="nav-title" href="index.html">{{$menu->title}}</a>
                    @endif
                @endforeach


            </section>

        </div>
    </nav>
</header>


<div class="container p-0">

    <!-- Barre de nav "INFO"-->
    <section class="barre-info ">
        <div class="wrapper d-flex align-items-center flex-wrap justify-content-center justify-content-lg-start">
            <!-- wrapper -->

            <h1>Info</h1>
            @foreach($menus as $menu)
                @if($menu->thirdNav)
                    <a class="nav-title" href="#">{{$menu->title}}</a>
                @endif
            @endforeach

        </div>
    </section>

    <!-- barre "En ce moment" (ecm)"-->
    <section class="barre-ecm">
        <div class="wrapper d-flex align-items-center flex-wrap justify-content-center justify-content-lg-start">
            <!-- wrapper -->

            <h2>EN CE MOMENT</h2>
            @foreach($menus as $menu)
                @if($menu->fourthNav && $menu->red==null)
                    <a href="#">{{$menu->title}}</a>
                @elseif($menu->red)
                    <a href="#">🔴{{$menu->title}}</a>
                @endif
            @endforeach

        </div>
    </section>

</div>

@yield('content')

</body>


<footer class="footer-rtbf">
    <div class="container">
        <section class="footer-top d-flex flex-column flex-lg-row align-items-center">
            <div class="chaines d-flex align-items-center justify-content-end justify-content-lg-start p-lg-0 p-3">
                <a href="#"><img class="logo" src="/img/RTBF.svg" alt="rtbf"></a>
                <a href="#"><img class="auvio" src="/img/Auvio.svg" alt="auvio"></a>
            </div>

            <div class="app d-flex align-items-center justify-content-lg-between justify-content-end p-lg-0 p-3">
                <a href="#"><img src="/img/disponible-google-play.svg" alt="google play"></a>
                <a href="#"><img src="/img/disponible-app-store.svg" alt="app store"></a>
            </div>

            <div class="r-s ">
                <p class="suivez-nous">Suivez-nous</p>
                <ul class="r-s-logos d-flex justify-content-between m-0 p-0">
                    <a href="#"><img src="/img/facebook.svg" alt="facebook"></a>
                    <a href="#"><img src="/img/twitter.svg" alt="twitter"></a>
                    <a href="#"><img src="/img/linkedin.svg" alt="linkedin"></a>
                </ul>
            </div>
        </section>

        <nav class="footer-box d-flex flex-column flex-lg-row align-items-center align-items-lg-start w-100">
            <div class="footer-list">
                <h5>Thématiques</h5>
                @foreach($footers as $footer)
                    @if($footer->col == 1)
                        <a href="#">{{$footer->title}}</a>
                    @endif
                @endforeach
            </div>
            <div class="footer-list">
                <h5>Services</h5>
                @foreach($footers as $footer)
                    @if($footer->col == 2)
                        <a href="#">{{$footer->title}}</a>
                    @endif
                @endforeach
            </div>
            <div class="footer-list">
                <h5>L'Actu décryptée</h5>
                @foreach($footers as $footer)
                    @if($footer->col == 3)
                        <a href="#">{{$footer->title}}</a>
                    @endif
                @endforeach
            </div>
            <div class="footer-list">
                <h5>Radios</h5>
                @foreach($footers as $footer)
                    @if($footer->col == 4)
                        <a href="#">{{$footer->title}}</a>
                    @endif
                @endforeach
            </div>
            <div class="footer-list">
                <h5>Émissions</h5>
                @foreach($footers as $footer)
                    @if($footer->col == 5)
                        <a href="#">{{$footer->title}}</a>
                    @endif
                @endforeach
            </div>
            <div class="footer-list">
                <h5>Nous contacter</h5>
                @foreach($footers as $footer)
                    @if($footer->col == 6)
                        <a href="#">{{$footer->title}}</a>
                    @endif
                @endforeach
            </div>
        </nav>

        <p class="copyright">Copyright © 2023 RTBF</p>

        <div class="mentions">
            @foreach($footers as $footer)
                @if($footer->col == 7)
                    <a href="#">{{$footer->title}}</a>
                    <span class="point"> . </span>
                @endif
            @endforeach
        </div>
    </div>
</footer>

</html>
