<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Nette\Utils\Paginator;

class BlogController extends Controller
{
    public function index() {
        return View('blog.index', [
            'posts' => Post::all()
        ]);
    }

    public function show(String $slug, Post $post) {

        if ($post->slug != $slug) {
            return redirect()->route('blog.show', ['slug' => $post->slug, 'id' => $post->id ]);
        }

        return view('blog.show', ['post' =>$post]);
    }

    public function create() {
        return view('blog.create');

    }

    public function store(CreatePostRequest $request) {
        $post = Post::create($request->validated());
        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success',
        "l'article a bien été sauvegardé");
    }
}
