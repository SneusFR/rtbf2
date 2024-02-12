<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class FavController extends Controller
{
    public function toggleFavorite(Request $request, $postId)
    {
        return redirect(route(blog.index));
        $user = auth()->user();
        $post = Post::findOrFail($postId);

        if ($user->favoritePosts()->where('post_id', $postId)->exists()) {
            $user->favoritePosts()->detach($postId);
            return response()->json(['message' => 'Removed from favorites']);
        } else {
            $user->favoritePosts()->attach($postId);
            return response()->json(['message' => 'Added to favorites']);
        }
    }

}
