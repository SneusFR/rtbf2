<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\footer;
use App\Models\menu;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{

    public function getMeteo()
    {
        $response = Http::withOptions(['verify' => false])->get('https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/brussels?unitGroup=metric&include=days&key=8J2PR2ABNQEAG3LPGHQ87XY3T&contentType=json');
        return $response->json();
    }

    public function doSearch(Request $request)
    {
        // Récupérer la requête de recherche depuis la requête HTTP
        $query = $request->input('query');
        $meteo = $this->getMeteo();
        $theme = $request->cookie('theme', 'light');

        // Effectuer la recherche dans les titres et le contenu des articles
        $posts = Post::where('title_pos', 'like', '%' . $query . '%')
            ->orWhere('content_pos', 'like', '%' . $query . '%')
            ->orWhere('cate_pos', 'like', '%' . $query . '%')
            ->paginate(10);

        // Passer les résultats de recherche à la vue
        return view('search.search', ['meteo' => $meteo, 'posts' => $posts, 'menus' => menu::all(), 'footers' => footer::all(), 'theme' => $theme, 'query' => $query]);
    }

}
