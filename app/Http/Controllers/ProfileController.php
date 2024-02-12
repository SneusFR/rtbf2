<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use App\Models\footer;
use App\Models\menu;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function mainProfile() {
        return view('profile.mainProfile', ['menus' => menu::all(), 'footers' => footer::all()]);
    }

}
