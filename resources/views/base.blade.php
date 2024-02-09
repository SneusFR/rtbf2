<!doctype html>
<html lang="fr">
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RTBF.be - La référence de l'actualité belge et internationale - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>

<header class="header-rtbf">
    <nav class="navigation">
        <div class="container">

            <section class="nav-top d-flex align-items-center justify-content-between flex-wrap">
                <div class=" nav-top-left d-flex justify-content-center col-lg-10 col-12 flex-wrap">
                    <a href="index.html"><img class="logo" src="/img/RTBF.svg" alt="Logo" ></a>
                        @foreach($menus as $menu)
                            @if($menu->firstNav)
                            <a class="nav-title" href="#">{{$menu->title}}</a>
                        @endif
                    @endforeach
                </div>
                <div class="nav-top-right d-flex justify-content-center col-lg-2 col-12">
                    <input id="search-bar" name="search-bar" type="text">
                    <a href="#"><img src="/img/search.svg" alt="recherche"></a>
                    <a href="#"><img src="/img/sun.svg" alt="météo"></a>
                    <a href="user.html"><img src="/img/user.svg" alt="user"></a>
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
        <div class="wrapper d-flex align-items-center flex-wrap justify-content-center justify-content-lg-start"> <!-- wrapper -->

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
        <div class="wrapper d-flex align-items-center flex-wrap justify-content-center justify-content-lg-start"> <!-- wrapper -->

            <h2>EN CE MOMENT</h2>
            @foreach($menus as $menu)
                @if($menu->fourthNav)
                <a href="#">{{$menu->title}}</a>
                @endif
            @endforeach
            <a href="#">🔴Guerre en Ukraine</a>
            <a href="#">Prix de l'énergie</a>
            <a href="#">Le fil info</a>
            <a href="#">Décrypte</a>

        </div>
    </section>

</div>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif

    @yield('content')
</div>

</body>
</html>
