<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\footer;
use App\Models\menu;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller
{


    public function doSearch(Request $request)
    {
        // Récupérer la requête de recherche depuis la requête HTTP
        $query = $request->input('query');

        $theme = $request->cookie('theme', 'light');

        // Effectuer la recherche dans les titres et le contenu des articles
        $posts = Post::where('title_pos', 'like', '%' . $query . '%')
            ->orWhere('content_pos', 'like', '%' . $query . '%')
            ->orWhere('cate_pos', 'like', '%' . $query . '%')
            ->paginate(1);

        // Passer les résultats de recherche à la vue
        return view('search.search', ['posts' => $posts, 'menus' => menu::all(), 'footers' => footer::all(), 'theme' => $theme, 'query' => $query]);
    }

}
