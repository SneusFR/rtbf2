<?php

namespace App\Http\Controllers;
use App\Models\favorite;
use App\Models\footer;
use App\Models\menu;
use App\Models\Post;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index(Request $request) {

        $menus = Menu::all();
        $footers = Footer::all();
        $posts = Post::query();
        $favorite = favorite::all();

        $theme = $request->cookie('theme', 'light');


        $posts = $posts->latest()->get();

        // Récupérez l'article le plus récent et retirez-le du tableau
        $featuredPost = $posts->shift();

        // Récupérez les 2 articles suivants pour affichage à droite
        $rightSidePosts = $posts->splice(0, 2);

        // Les 4 articles restants sont ceux à afficher en bas
        $bottomPosts = $posts->splice(0, 4);

        // Passez les données à la vue
        return view('blog.index')->with('menus', $menus)
            ->with('featuredPost', $featuredPost)
            ->with('rightSidePosts', $rightSidePosts)
            ->with('bottomPosts', $bottomPosts)
            ->with('footers', $footers)
            ->with('favorite', $favorite)
            ->with('theme', $theme);
    }


    public function show(String $slug, Post $post, Request $request) {
        $theme = $request->cookie('theme', 'light');
        return view('blog.show', ['post' =>$post, 'menus' => menu::all(), 'footers' => footer::all(), 'theme' => $theme]);
    }

    public function create(Request $request) {
        $theme = $request->cookie('theme', 'light');
        return view('blog.create', ['menus' => menu::all(), 'footers' => footer::all(), 'theme' => $theme]);
    }

    public function store(CreatePostRequest $request) {
        // Créer un nouvel enregistrement de modèle Post avec les données validées

        $auteur = Auth::user();

        $alias = $auteur->name.' '.$auteur->firstname;

        $post = Post::create($request->validated());

        // Stocker l'ateur dans le modèle Post
        $post->auteur = $alias;

// Vérifier si un fichier image a été téléchargé
        if ($request->hasFile('image')) {
            // Récupérer le fichier téléchargé
            $image = $request->file('image');

            // Construire le nom de fichier en utilisant le slug et l'id du post
            $filename = $post->slug . '' . $post->id . '.' . $image->getClientOriginalExtension();

            // Stocker l'image avec le nom de fichier spécifié
            $path = $image->storeAs('', $filename, 'custom');

            $extension = $image->getClientOriginalExtension();

            // Stocker l'extension dans le modèle Post
            $post->extension = $extension;

            // Sauvegarder le modèle Post avec l'extension mise à jour
            $post->save();

        }

            return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success',
        "l'article a bien été sauvegardé");
    }

    public function about(Request $request)
    {
        $theme = $request->cookie('theme', 'light');
        return view('static.about', ['menus' => menu::all(), 'footers' => footer::all(), 'theme' => $theme]);
    }

    public function createAndUpdate(Request $request) {

        $theme = $request->input('theme');


        if($theme && in_array($theme, ['light', 'Dark'])) {

            $cookie = cookie('theme', $theme, 60*24*365);

            return back()->withCookie($cookie);

        }
    }

}
