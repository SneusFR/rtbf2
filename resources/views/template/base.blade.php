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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/main.css">
    <link rel= "stylesheet" href= "https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" >


</head>
<body class="{{$theme == 'Dark' ? 'dark-body' : 'body'}}">

<header class="header-rtbf">
    <nav class="{{$theme == 'Dark' ? 'dark_navigation' : 'navigation'}}">

        <div class="container">

            <section class="nav-top d-flex align-items-center justify-content-between flex-wrap">

                <span class="navbar-text">
                    <form action = "{{route ('blog.create-update')}}" method="post" class="d-flex">
                        @csrf
                        <input class="btn-check" type="radio" name="theme" id="theme" value="{{$theme == 'Dark' ? 'light' : 'Dark'}}" onchange="this.form.submit()">
                            @if($theme == 'Dark')
                            <label for="theme" class="btn btn-secondary toggle-btn-dark">
                                <i><img id="light" src="/img/light.svg"></i>
                            </label>
                            @else
                            <label for="theme" class="btn btn-secondary toggle-btn-light">
                                <i><img id="dark" src="/img/moon.png"></i>
                            </label>
                            @endif
                    </form>
                </span>

                <div class=" nav-top-left d-flex justify-content-center col-lg-8 col-12 flex-wrap">
                    <a href={{route('blog.index')}}><img class="logo" src="/img/RTBF.svg" alt="Logo"></a>
                    @foreach($menus as $menu)
                        @if($menu->firstNav_menu)
                            <a class="nav-title" href="{{route($menu->routes_menu)}}">{{$menu->title_menu}}</a>
                        @endif
                    @endforeach
                    @Auth
                    @if (Auth::user()->role_user == "Admin")
                        <a class="nav-title" href="{{route('blog.create')}}">Publier</a>
                    @endif
                    @endauth
                </div>

                <div class="nav-top-right d-flex justify-content-center col-lg-2 col-12">
                    <a href={{route('blog.search')}}><img src="/img/search.svg" alt="recherche"></a>
                    <a href="{{route('blog.meteo')}}" class="tooltiped"><img  src="/img/sun.svg" alt="météo"></a>


                    <div id="tooltip" class="row {{$theme == 'Dark' ? 'bg-dark bg-gradient text-white' : ' bg-gradient text-dark'}}">

                        <p class="d-none">
                            @php
                                $joursDeLaSemaine = [];
                            @endphp
                            @foreach(array_slice($meteo['days'], 0, 4) as $day)
                                @php
                                    $carbonDate = \Carbon\Carbon::parse($day['datetime']);
                                    $jour = $carbonDate->dayName;

                                    $joursDeLaSemaine[] = $jour;
                                @endphp
                            @endforeach
                        </p>

                        <p class="meteo-location" style="font-weight: bold">
                            {{$meteo['resolvedAddress']}} : {{$meteo['days'][0]['datetime']}}
                        </p>

                        <section class="meteo-du-jour row mb-2">
                            <div class="col-6">
                                <p>Température : {{$meteo['days'][0]['temp']}} °C</p>
                                <p>Précipitation : {{$meteo['days'][0]['precip']}} %</p>
                            </div>
                            <div class="col-6">
                                <p>Humidité : {{$meteo['days'][0]['humidity']}}%</p>
                                <p>Vent : {{$meteo['days'][0]['windspeed']}} km/h</p>
                            </div>
                        </section>

                        <section class="meteo-semaine d-flex justify-content-center">

                            @for ($i = 0; $i < 4; $i++)
                                <div>
                                    <p>{{$joursDeLaSemaine[$i]}}</p>
                                    <img src="/img/sun.svg">
                                    <p>{{$meteo['days'][$i]['tempmax']}} °C / {{$meteo['days'][$i]['tempmin']}} °C</p>
                                </div>
                            @endfor

                        </section>

                    </div>

                    <script src="/js/tooltip.js"></script>

                    @guest()
                        <a href={{route('auth.login')}}><img src="/img/user.svg" alt="user"></a>
                    @endguest
                    @auth()
                        <a href={{route('profile.profile')}}><img src="/img/user.svg" alt="user"></a>
                        <div class="id-user"> {{Auth::user()->name_user.' '.Auth::user()->firstname_user}}</div>
                    @endauth

                </div>
            </section>

            <section class="nav-bot">
                <a class="menu" href="#">menu</a>
                @foreach($menus as $menu)
                    @if($menu->secondNav_menu)
                        <a class="nav-title" href="{{route($menu->routes_menu)}}">{{$menu->title_menu}}</a>
                    @endif
                @endforeach
            </section>

        </div>
    </nav>
</header>


<div class="container p-0">

    <!-- Barre de nav "INFO"-->
    <section class={{$theme == 'Dark' ? 'dark_barre-info' : 'barre-info'}}>
        <div class="wrapper d-flex align-items-center flex-wrap justify-content-center justify-content-lg-start">
            <!-- wrapper -->

            <h1>Info</h1>
            @foreach($menus as $menu)
                @if($menu->thirdNav_menu)
                    <a class="nav-title" href="#">{{$menu->title_menu}}</a>
                @endif
            @endforeach

        </div>
    </section>

    <!-- barre "En ce moment" (ecm)"-->
    <section class={{$theme == 'Dark' ? 'dark-barre-ecm' : 'barre-ecm'}}>
        <div class="wrapper d-flex align-items-center flex-wrap justify-content-center justify-content-lg-start">
            <!-- wrapper -->

            <h2>EN CE MOMENT</h2>
            @foreach($menus as $menu)
                @if($menu->fourthNav_menu && $menu->red_menu==null)
                    <a href="#">{{$menu->title_menu}}</a>
                @elseif($menu->red_menu)
                    <a href="#">🔴{{$menu->title_menu}}</a>
                @endif
            @endforeach

        </div>
    </section>

</div>

@yield('content')

</body>


<footer class="{{$theme == 'Dark' ? 'dark-footer-rtbf' : 'footer-rtbf'}}">
    <div class="container">
        <section class="{{$theme == 'Dark' ? 'dark-footer-top' : 'footer-top'}} d-flex flex-column flex-lg-row align-items-center">
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
            <div class="{{$theme == 'Dark' ? 'dark-footer-list' : 'footer-list'}}">
                <h5>Thématiques</h5>
                @foreach($footers as $footer)
                    @if($footer->col_foot == 1)
                        <a href="#">{{$footer->title_foot}}</a>
                    @endif
                @endforeach
            </div>
            <div class="{{$theme == 'Dark' ? 'dark-footer-list' : 'footer-list'}}">
                <h5>Services</h5>
                @foreach($footers as $footer)
                    @if($footer->col_foot == 2)
                        <a href="#">{{$footer->title_foot}}</a>
                    @endif
                @endforeach
            </div>
            <div class="{{$theme == 'Dark' ? 'dark-footer-list' : 'footer-list'}}">
                <h5>L'Actu décryptée</h5>
                @foreach($footers as $footer)
                    @if($footer->col_foot == 3)
                        <a href="#">{{$footer->title_foot}}</a>
                    @endif
                @endforeach
            </div>
            <div class="{{$theme == 'Dark' ? 'dark-footer-list' : 'footer-list'}}">
                <h5>Radios</h5>
                @foreach($footers as $footer)
                    @if($footer->col_foot == 4)
                        <a href="#">{{$footer->title_foot}}</a>
                    @endif
                @endforeach
            </div>
            <div class="{{$theme == 'Dark' ? 'dark-footer-list' : 'footer-list'}}">
                <h5>Émissions</h5>
                @foreach($footers as $footer)
                    @if($footer->col_foot == 5)
                        <a href="#">{{$footer->title_foot}}</a>
                    @endif
                @endforeach
            </div>
            <div class="{{$theme == 'Dark' ? 'dark-footer-list' : 'footer-list'}}">
                <h5>Nous contacter</h5>
                @foreach($footers as $footer)
                    @if($footer->col_foot == 6)
                        <a href="#">{{$footer->title_foot}}</a>
                    @endif
                @endforeach
            </div>
        </nav>

        <p class="{{$theme == 'Dark' ? 'dark-copyright' : 'copyright'}}"> {{$theme == 'Dark' ? 'bg-dark' : 'bg-light'}} thème</p>

        <div class="{{$theme == 'Dark' ? 'dark-mentions' : 'mentions'}}">
            @foreach($footers as $footer)
                @if($footer->col_foot == 7)
                    <a href="#">{{$footer->title_foot}}</a>
                    <span class="point"> . </span>
                @endif
            @endforeach
        </div>
    </div>
</footer>

</html>
