<?php

namespace App\Http\Controllers;
use App\Models\favorite;
use App\Models\favorite_post_user;
use App\Models\footer;
use App\Models\menu;
use App\Models\Post;
use Illuminate\Http\Request;

class FavController extends Controller
{


    public function main_favorite() {
        $user = auth()->user();

        if ($user) {
            $favoritePosts = $user->favoritePosts()->get();
            // Maintenant, $favoritePosts contient une collection de tous les articles favorisés par l'utilisateur
            return view('fav.mainFavorite', ['favoritePosts' => $favoritePosts, 'menus' => menu::all(), 'footers' => footer::all()]);
        }

        else {

            return redirect(route('auth.login'));

        }
    }


    public function toggleFavorite(Request $request)
    {

        $user = auth()->user();

        if ($user) {


            $postId = $request->post_id;
            $user = auth()->user();
            $post = Post::findOrFail($postId);

            if ($user->favoritePosts()->where('post_id', $postId)->exists()) {
                $user->favoritePosts()->detach($postId);
                return redirect()->route('blog.index')->with('fail', "L'article a bien été retiré des favoris");
            }

            else {
                $user->favoritePosts()->attach($postId);
                return redirect()->route('blog.index')->with('success', "L'article a bien été mis en favoris");


            }

        }

        else {
            return redirect(route('auth.login'));
        }
    }

}
