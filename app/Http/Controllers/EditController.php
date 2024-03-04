<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UpdatingRequest;
use App\Models\footer;
use App\Models\menu;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class EditController extends Controller
{

    public function getMeteo()
    {
        $response = Http::withOptions(['verify' => false])->get('https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/brussels?unitGroup=metric&include=days&key=8J2PR2ABNQEAG3LPGHQ87XY3T&contentType=json');
        return $response->json();
    }

    public function editProfile(Request $request)
    {
        $meteo = $this->getMeteo();
        $theme = $request->cookie('theme', 'light');
        return view('edit.edit', ['meteo' => $meteo, 'menus' => menu::all(), 'footers' => footer::all(), 'theme' => $theme]);
    }

    public function updateProfile(UpdatingRequest $request)
    {

        $updateInfo = $request->validated();

        // Update les données du User
        $user = Auth::user();

        $user->name_user = $updateInfo['nom'];
        $user->firstname_user = $updateInfo['prénom'];
        $user->adresse_user = $updateInfo['adresse'];
        $user->cp_user = $updateInfo['cp'];
        $user->ville_user = $updateInfo['ville'];
        $user->tel_user = $updateInfo['tel'];
        $user->pref_user = $updateInfo['pref'];
        $user->genre_user = $updateInfo['genre'];

        $user->save();

        return redirect()->route('profile.profile')->with('success', "Données mis à jour avec succès {$updateInfo['prénom']} !");

    }

    public function editPassword(Request $request)
    {
        $meteo = $this->getMeteo();
        $theme = $request->cookie('theme', 'light');
        return view('edit.password', ['meteo' => $meteo, 'menus' => menu::all(), 'footers' => footer::all(), 'theme' => $theme]);
    }

    public function doEditArt(String $slug, Post $post, CreatePostRequest $request) {

        $updateInfo = $request->validated();

        $post->title_pos = $updateInfo['title_pos'];
        $post->hook_pos = $updateInfo['hook_pos'];
        $post->slug_pos = $updateInfo['slug_pos'];
        $post->content_pos = $updateInfo['content_pos'];
        $post->cate_pos = $updateInfo['cate_pos'];

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

        }


        $post->save();

        return redirect()->route('blog.index')->with('success', "Article éditer avec succès !");

    }

    public function editArt(String $slug, Post $post, Request $request) {
        // Vérifier si un utilisateur est connecté et s'il a le rôle admin
        if (Auth::check() && Auth::user()->role_user == 'Admin') {
            $meteo = $this->getMeteo();
            $theme = $request->cookie('theme', 'light');
            return view('edit.editArt', ['meteo'=> $meteo, 'post' =>$post, 'menus' => menu::all(), 'footers' => footer::all(), 'theme' => $theme]);
        } else {
            // Rediriger vers la page de connexion si l'utilisateur n'est pas un administrateur
            return redirect()->route('blog.index');
        }
    }

    public function updatePassword(PasswordRequest $request)
    {

        $editPassword = $request->validated();

        // Update les données du User
        $user = Auth::user();

        // Vérifier si l'ancien mot de passe correspond au mot de passe haché stocké dans la base de données
        if (Hash::check($editPassword['old-password'], $user->password)) {

            // Ancien mot de passe correct, vous pouvez procéder à la suite
            if ($editPassword['new-password'] == $editPassword['new2-password']) {

                // Mettre à jour le mot de passe avec le nouveau mot de passe haché
                $user->password = Hash::make($editPassword['new-password']);

                $user->save();

                return redirect()->route('edit.edit')->with('success', 'Mot de passe mis à jour avec succès.');

            } else {

                // Ancien mot de passe incorrect, renvoyer une erreur
                return redirect()->back()->with('fail', 'Les nouveaux mots de passe ne correspondent pas.');
            }

        } else {
            // Ancien mot de passe incorrect, renvoyer une erreur
            return redirect()->back()->with('fail', 'Ancien mot de passe incorrect.');
        }


    }

}
