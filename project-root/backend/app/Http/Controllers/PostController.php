<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
    
        $user = auth()->user();
    
        if ($user->posts()->whereDate('created_at', today())->count() >= 3) {
            return response()->json(['error' => 'Günde en fazla 3 blog oluşturabilirsiniz.'], 403);
        }
    
        $slug = Str::slug($request->title) . '-' . uniqid();
    
        $post = $user->posts()->create([
            'title' => $request->title,
            'content' => $request->content,
            'slug' => $slug,
        ]);
    
        return response()->json($post, 201);
    }
    public function index()
{
    $posts = Post::paginate(20);
    return response()->json($posts);
}

public function show($slug)
{
    $post = Cache::remember("post_{$slug}", 3600, function () use ($slug) {
        return Post::where('slug', $slug)->firstOrFail();
    });

    return response()->json($post);
}

}
