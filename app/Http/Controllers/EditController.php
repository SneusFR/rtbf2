<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UpdatingRequest;
use App\Models\footer;
use App\Models\menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditController extends Controller
{
    public function editProfile(Request $request)
    {
        $theme = $request->cookie('theme', 'light');
        return view('edit.edit', ['menus' => menu::all(), 'footers' => footer::all(), 'theme' => $theme]);
    }

    public function updateProfile(UpdatingRequest $request)
    {

        $updateInfo = $request->validated();

        // Update les données du User
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

        return redirect()->route('profile.profile')->with('success', "Données mis à jour avec succès {$updateInfo['prénom']} !");

    }

    public function editPassword(Request $request)
    {
        $theme = $request->cookie('theme', 'light');
        return view('edit.password', ['menus' => menu::all(), 'footers' => footer::all(), 'theme' => $theme]);
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
