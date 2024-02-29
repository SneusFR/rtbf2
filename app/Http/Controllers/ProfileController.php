<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use App\Http\Requests\UpdatingRequest;
use App\Models\footer;
use App\Models\menu;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    public function getMeteo()
    {
        $response = Http::withOptions(['verify' => false])->get('https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/brussels?unitGroup=metric&include=days&key=8J2PR2ABNQEAG3LPGHQ87XY3T&contentType=json');
        return $response->json();
    }

    public function mainProfile(Request $request) {

        $meteo = $this->getMeteo();
        $theme = $request->cookie('theme', 'light');
        return view('profile.mainProfile', ['meteo' => $meteo, 'menus' => menu::all(), 'footers' => footer::all(), 'theme' => $theme]);
    }

}
