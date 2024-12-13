<?php

namespace App\Http\Controllers;

abstract class Controller
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

}
