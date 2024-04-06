<?php

namespace App\Http\Controllers;
use App\Models\favorite;
use App\Models\favorite_post_user;
use App\Models\footer;
use App\Models\menu;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FavController extends Controller
{
    public function getMeteo()
    {
        $response = Http::withOptions(['verify' => false])->get('https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/brussels?unitGroup=metric&include=days&key=8J2PR2ABNQEAG3LPGHQ87XY3T&contentType=json');
        return $response->json();
    }

    public function main_favorite(Request $request)
    {
        $user = auth()->user();

        $meteo = $this->getMeteo();
        $theme = $request->cookie('theme', 'light');

        if ($user) {
            $favoritePosts = $user->favoritePosts()->get();
            // Maintenant, $favoritePosts contient une collection de tous les articles favorisés par l'utilisateur
            return view('fav.mainFavorite', ['meteo' => $meteo, 'favoritePosts' => $favoritePosts, 'menus' => menu::all(), 'footers' => footer::all(), 'theme' => $theme]);
        } else {

            return redirect(route('auth.login'));

        }
    }


    public function toggleFavorite(Request $request)
    {

        $user = auth()->user();

        if ($user) {


            $postId = $request->post_id;
            $user = auth()->user();

            if ($user->favoritePosts()->where('post_id_fav', $postId)->exists()) {
                $user->favoritePosts()->detach($postId);
                return redirect()->route('blog.index')->with('fail', "L'article a bien été retiré des favoris");
            } else {
                $user->favoritePosts()->attach($postId);
                return redirect()->route('blog.index')->with('success', "L'article a bien été mis en favoris");

            }

        } else {
            return redirect(route('auth.login'));
        }
    }

    public function getFavorite()
    {
        $user = auth()->user();

        if ($user) {
            $favoritePosts = $user->favoritePosts()->get();
            return response()->json($favoritePosts);
        } else {
            return redirect()->route('auth.login');
        }
    }


}
