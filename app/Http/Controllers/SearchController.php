<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\footer;
use App\Models\menu;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $theme = $request->cookie('theme', 'light');
        return view('search.search', ['menus' => menu::all(), 'footers' => footer::all(), 'theme' => $theme]);
    }

    public function doSearch(Request $request)
    {
        // Récupérer la requête de recherche depuis la requête HTTP
        $query = $request->input('query');

        $theme = $request->cookie('theme', 'light');

        // Effectuer la recherche dans les titres et le contenu des articles
        $posts = Post::where('title_pos', 'like', '%' . $query . '%')
            ->orWhere('content_pos', 'like', '%' . $query . '%')
            ->orWhere('cate_pos', 'like', '%' . $query . '%')
            ->get();

        // Passer les résultats de recherche à la vue
        return view('search.dosearch', ['posts' => $posts, 'menus' => menu::all(), 'footers' => footer::all(), 'theme' => $theme]);    }

}
