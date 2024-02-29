
@extends('template.base')

@section('title')
    Acceuil
@endsection

@section('content')

    <main class="{{$theme == 'Dark' ? 'dark-home-index' : 'home-index'}} container">

        <div class="container">

            <div class="wrapper "> <!-- wrapper -->

                <p class="d-none">
                    @php
                        $joursDeLaSemaine = [];
                    @endphp
                    @foreach(array_slice($meteo['days'], 0, 7) as $day)
                        @php
                            $carbonDate = \Carbon\Carbon::parse($day['datetime']);
                            $jour = $carbonDate->dayName;

                            $joursDeLaSemaine[] = $jour;
                        @endphp
                    @endforeach
                </p>

                <p class="meteo-location" style="font-weight: bold">
                    {{$meteo['resolvedAddress']}}
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

                    <div>
                        <p>{{$joursDeLaSemaine[0]}}</p>
                        <img src="/img/sun.svg">
                        <p> {{$meteo['days'][0]['tempmax']}} °C / {{$meteo['days'][0]['tempmin']}} °C</p>
                    </div>

                    <div>
                        <p>{{$joursDeLaSemaine[1]}}</p>
                        <img src="/img/sun.svg">
                        <p>{{$meteo['days'][1]['tempmax']}} °C / {{$meteo['days'][1]['tempmin']}} °C</p>
                    </div>

                    <div>
                        <p>{{$joursDeLaSemaine[2]}}</p>
                        <img src="/img/sun.svg">
                        <p>{{$meteo['days'][2]['tempmax']}} °C / {{$meteo['days'][2]['tempmin']}} °C</p>
                    </div>

                    <div>
                        <p>{{$joursDeLaSemaine[3]}}</p>
                        <img src="/img/sun.svg">
                        <p>{{$meteo['days'][3]['tempmax']}} °C / {{$meteo['days'][3]['tempmin']}} °C</p>
                    </div>

                    <div>
                        <p>{{$joursDeLaSemaine[4]}}</p>
                        <img src="/img/sun.svg">
                        <p>{{$meteo['days'][4]['tempmax']}} °C / {{$meteo['days'][3]['tempmin']}} °C</p>
                    </div>

                    <div>
                        <p>{{$joursDeLaSemaine[5]}}</p>
                        <img src="/img/sun.svg">
                        <p>{{$meteo['days'][5]['tempmax']}} °C / {{$meteo['days'][3]['tempmin']}} °C</p>
                    </div>

                    <div>
                        <p>{{$joursDeLaSemaine[6]}}</p>
                        <img src="/img/sun.svg">
                        <p>{{$meteo['days'][6]['tempmax']}} °C / {{$meteo['days'][3]['tempmin']}} °C</p>
                    </div>

                </section>

            </div>
        </div>
    </main>

@endsection
