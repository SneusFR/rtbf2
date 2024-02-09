<?php

namespace App\Http\Controllers;
use App\Models\menu;
use App\Models\Post;
use App\Http\Requests\CreatePostRequest;

class BlogController extends Controller
{
    public function index() {
        $menus = Menu::all();
        return view('blog.index')->with('menus', $menus)->with('posts', Post::all());
    }

    public function show(String $slug, Post $post) {
        return view('blog.show', ['post' =>$post, 'menus' => menu::all()]);
    }

    public function create() {
        return view('blog.create', ['menus' => menu::all()]);

    }

    public function store(CreatePostRequest $request) {
        $post = Post::create($request->validated());
        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success',
        "l'article a bien été sauvegardé");
    }
}
