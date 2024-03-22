<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginAPIRequest;
use App\Http\Requests\loginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\footer;
use App\Models\menu;
use App\Models\User;
use Illuminate\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function getMeteo()
    {
        $response = Http::withOptions(['verify' => false])->get('https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/brussels?unitGroup=metric&include=days&key=8J2PR2ABNQEAG3LPGHQ87XY3T&contentType=json');
        return $response->json();
    }

    public function login(Request $request) {
        $meteo = $this->getMeteo();
        $theme = $request->cookie('theme', 'light');

        return view('auth.login',['meteo' => $meteo, 'menus' => menu::all(), 'footers' => footer::all(), 'theme' => $theme]);
    }

    public function logout() {
        Auth::logout();
       return redirect()->route('auth.login')->with('fail', "Vous êtes bien déconnecté");
    }

   public function doLogin(loginRequest $request) {

        $loginInfo = $request->validated();
        if(Auth::attempt($loginInfo)) {
            $user = Auth::user(); // Obtenir l'utilisateur authentifié
            $userName = $user->name_user.' '.$user->firstname_user; // Récupérer le nom de l'utilisateur
            $request->session()->regenerate();
            return redirect()->route('blog.index')->with('success', "Vous êtes connecté en tant que $userName");
        }

        return redirect()->route('auth.login')->withErrors([
            'email' => "Email invalide"
        ])->onlyInput('email');
   }

   public function register (Request $request) {
       $meteo = $this->getMeteo();

       $theme = $request->cookie('theme', 'light');

        return view('auth.register', ['meteo' => $meteo, 'menus' => menu::all(), 'footers' => footer::all(),'theme' => $theme]);
}

    public function doRegister(RegisterRequest $request)
    {
        $registerInfo = $request->validated();

        // Créer un nouvel utilisateur avec les données postées
        $user = User::create([
            'email' => $registerInfo['email'],
            'password' => Hash::make($registerInfo['password']), // Assurez-vous de hasher le mot de passe
            'name_user' => $registerInfo['nom'],
            'firstname_user' =>$registerInfo['prénom'],
            'adresse_user' => $registerInfo['adresse'],
            'cp_user' => $registerInfo['cp'],
            'role_user' => $registerInfo['rôle'] ?? 'Guest',
            'ville_user' => $registerInfo['ville'],
            'tel_user' => $registerInfo['tel'],
            'pref_user' => $registerInfo['pref'],
            'genre_user' => $registerInfo['genre'],

            // Ajoutez les autres champs de votre modèle User ici
        ]);

        return redirect()->route('auth.login')->with('success', "Vous vous êtes bien inscris {$registerInfo['prénom']} !");

    }


    // SE LOGIN VIA L'API FOURNIE PAR LE PROF
    public function loginAPI(Request $request) {
        $meteo = $this->getMeteo();
        $theme = $request->cookie('theme', 'light');

        return view('auth.loginAPI',['meteo' => $meteo, 'menus' => menu::all(), 'footers' => footer::all(), 'theme' => $theme]);
    }

    public function doLoginAPI(loginAPIRequest $request) {

        $loginInfo = $request->validated();

        $response = Http::withOptions(['verify' => false])->get("http://playground.burotix.be/login/?login={$loginInfo['login']}&passwd={$loginInfo['password']}");
        $userData = $response->json();

        //Si identified est à true
        if ($userData['identified']) {

            $user = User::where('login', $loginInfo['login'])->first();

            // Si le user n'existe pas, créer un nouvel utilisateur
            if (!$user) {

                $fullName = $userData['name'];
                $nameParts = explode(' ', $fullName);

                // Supposons que le premier élément est le prénom et le reste est le nom de famille
                $firstName = $nameParts[0];
                $lastName = implode(' ', array_slice($nameParts, 1));

                $newUser = new User();
                $newUser->firstname_user = $firstName;
                $newUser->name_user = $lastName;

                if ($userData['role'] == "admin"){
                    $newUser->role_user = "Admin";
                }else{
                    $newUser->role_user = "Guest";
                }
                
                $newUser->login = $loginInfo['login'];
                $newUser->password = Hash::make($loginInfo['password']);
                $newUser->email = str_replace(' ', '', $userData['name']) . '@gmail.com';
                $newUser->save();

                $user = $newUser;
            }

            // Connecter l''utilisateur
            auth()->login($user);

            return redirect()->route('blog.index')->with('success', "Vous êtes connecté en tant que $user->name_user");
        } else {
            // L'authentification a échoué, rediriger avec un message d'erreur
            return redirect()->route('auth.loginAPI')->with('fail', 'Identifiants incorrects');
        }
    }
















}

