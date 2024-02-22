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

class ProfileController extends Controller
{
    public function mainProfile(Request $request) {

        $theme = $request->cookie('theme', 'light');
        return view('profile.mainProfile', ['menus' => menu::all(), 'footers' => footer::all(), 'theme' => $theme]);
    }

    public function editProfile(Request $request) {
        $theme = $request->cookie('theme', 'light');
        return view('profile.edit', ['menus' => menu::all(), 'footers' => footer::all(), 'theme' => $theme]);
    }

    public function updateProfile(UpdatingRequest $request) {

        $updateInfo = $request->validated();

        // Créer un nouvel utilisateur avec les données postées
        $user = Auth::user();

            $user->name = $updateInfo['nom'];
            $user->firstname = $updateInfo['prénom'];
            $user->adresse = $updateInfo['adresse'];
            $user->cp = $updateInfo['cp'];
            $user->ville = $updateInfo['ville'];
            $user->tel = $updateInfo['tel'];
            $user->pref = $updateInfo['pref'];
            $user->genre = $updateInfo['genre'];

            $user->save();

        return redirect()->route('profile.profile')->with('success', "Vous avez bien mis vos données à jour {$updateInfo['prénom']} !");

    }

}
