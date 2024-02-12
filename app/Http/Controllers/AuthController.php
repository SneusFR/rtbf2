<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\footer;
use App\Models\menu;
use App\Models\User;
use Illuminate\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login',['menus' => menu::all(), 'footers' => footer::all()]);
    }

    public function logout() {
        Auth::logout();
       return redirect()->route('auth.login');
    }

   public function doLogin(loginRequest $request) {

        $loginInfo = $request->validated();
        if(Auth::attempt($loginInfo)) {
            $request->session()->regenerate();
            return redirect()->route('blog.index');
        }

        return redirect()->route('auth.login')->withErrors([
            'email' => "Email invalide"
        ])->onlyInput('email');
   }

   public function register () {
        return view('auth.register', ['menus' => menu::all(), 'footers' => footer::all()]);
}

    public function doRegister(RegisterRequest $request)
    {

        $registerInfo = $request->validated();

        // Créer un nouvel utilisateur avec les données postées
        $user = User::create([
            'email' => $registerInfo['email'],
            'password' => bcrypt($registerInfo['password']), // Assurez-vous de hasher le mot de passe
            'name' => $registerInfo['nom'],
            'firstname' =>$registerInfo['prénom'],
            'Adresse' => $registerInfo['adresse'],
            'CP' => $registerInfo['cp'],
            'rôle' => $registerInfo['rôle'],
            'Ville' => $registerInfo['ville'],
            'numTel' => $registerInfo['tel'],
            // Ajoutez les autres champs de votre modèle User ici
        ]);

    }
















}

