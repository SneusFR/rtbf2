
@extends('template.base')

@section('title')
    Acceuil
@endsection

@section('content')

    <main class="{{$theme == 'Dark' ? 'dark-home-index' : 'home-index'}} container">

        <div class="container" >

            <div class="wrapper pt-3 {{$theme == 'Dark' ? 'text-white' : 'text-dark'}}" > <!-- wrapper -->

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

                    @for ($i = 0; $i < count($joursDeLaSemaine); $i++)
                        <div>
                            <p>{{$joursDeLaSemaine[$i]}}</p>
                            <img src="/img/sun.svg">
                            <p>{{$meteo['days'][$i]['tempmax']}} °C / {{$meteo['days'][$i]['tempmin']}} °C</p>
                        </div>
                    @endfor

                </section>

            </div>
        </div>
    </main>

@endsection
