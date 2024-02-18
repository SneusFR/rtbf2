<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\footer;
use App\Models\menu;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search()
    {
        return view('search.search', ['menus' => menu::all(), 'footers' => footer::all()]);
    }

    public function doSearch(Request $request)
    {
        // Récupérer la requête de recherche depuis la requête HTTP
        $query = $request->input('query');

        // Effectuer la recherche dans les titres et le contenu des articles
        $posts = Post::where('titleArt', 'like', '%' . $query . '%')
            ->orWhere('content', 'like', '%' . $query . '%')
            ->orWhere('categorie', 'like', '%' . $query . '%')
            ->get();

        // Passer les résultats de recherche à la vue
        return view('search.dosearch', ['posts' => $posts, 'menus' => menu::all(), 'footers' => footer::all()]);    }

}
