<?php

namespace App\Http\Controllers;
use App\Models\favorite;
use App\Models\footer;
use App\Models\menu;
use App\Models\Post;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class BlogController extends Controller
{
    public function publicite()
    {
        $response = Http::get('http://playground.burotix.be/adv/banner_for_isfce.json');

        return $response->json();
    }

    public function index(Request $request) {


        $meteo = $this->getMeteo();
        $publicite = $this->publicite();
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
            ->with('theme', $theme)
            ->with('publicite', $publicite)
            ->with('meteo', $meteo);
    }

    public function getMeteo()
    {
        $response = Http::withOptions(['verify' => false])->get('https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/brussels/2024-02-28/2024-03-06?unitGroup=metric&include=days&key=8J2PR2ABNQEAG3LPGHQ87XY3T&contentType=json');
        return $response->json();
    }

    public function meteo(Request $request)
    {
        $meteo = $this->getMeteo();
        $theme = $request->cookie('theme', 'light');
        return view('blog.meteo', ['meteo'=> $meteo, 'menus' => menu::all(), 'footers' => footer::all(), 'theme' => $theme]);
    }

    public function show(String $slug, Post $post, Request $request) {

        $meteo = $this->getMeteo();
        $theme = $request->cookie('theme', 'light');
        return view('blog.show', ['meteo'=> $meteo, 'post' =>$post, 'menus' => menu::all(), 'footers' => footer::all(), 'theme' => $theme]);
    }

    public function create(Request $request) {

        $theme = $request->cookie('theme', 'light');
        return view('blog.create', ['meteo'=> $meteo, 'menus' => menu::all(), 'footers' => footer::all(), 'theme' => $theme]);
    }

    public function store(CreatePostRequest $request) {
        // Créer un nouvel enregistrement de modèle Post avec les données validées

        $auteur = Auth::user();

        $alias = $auteur->name_user.' '.$auteur->firstname_user;

        $post = Post::create([
            'title_pos' => $request['title_pos'],
            'hook_pos' => $request['hook_pos'],
            'slug_pos' => $request['slug_pos'],
            'content_pos' => $request['content_pos'],
            'cate_pos' => $request['cate_pos'],
            ]);

            // Stocker l'ateur dans le modèle Post
        $post->aut_pos = $alias;

// Vérifier si un fichier image a été téléchargé
        if ($request->hasFile('image')) {
            // Récupérer le fichier téléchargé
            $image = $request->file('image');

            // Construire le nom de fichier en utilisant le slug et l'id du post
            $filename = $post->slug_pos . '' . $post->id_pos . '.' . $image->getClientOriginalExtension();

            // Stocker l'image avec le nom de fichier spécifié
            $path = $image->storeAs('', $filename, 'custom');

            $extension = $image->getClientOriginalExtension();

            // Stocker l'extension dans le modèle Post
            $post->ext_pos = $extension;

            // Sauvegarder le modèle Post avec l'extension mise à jour
            $post->save();

        }

            return redirect()->route('blog.show', ['slug' => $post->slug_pos, 'post' => $post->id_pos])->with('success',
        "l'article a bien été sauvegardé");
    }

    public function about(Request $request)
    {
        $theme = $request->cookie('theme', 'light');
        return view('static.about', ['meteo'=> $meteo, 'menus' => menu::all(), 'footers' => footer::all(), 'theme' => $theme]);
    }

    public function createAndUpdate(Request $request) {

        $theme = $request->input('theme');


        if($theme && in_array($theme, ['light', 'Dark'])) {

            $cookie = cookie('theme', $theme, 60*24*365);

            return back()->withCookie($cookie);

        }
    }

}
