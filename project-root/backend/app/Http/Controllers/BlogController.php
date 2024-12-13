<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
{
    // Tüm blogları listeler.
    $blogs = Blog::latest()->get();

    return response()->json([
        'blogs' => $blogs
    ]);
}
public function show($id)
{
    // Blogu ID'ye göre bulunur.
    $blog = Blog::find($id);

    if (!$blog) {
        return response()->json([
            'message' => 'Blog bulunamadı.'
        ], 404);
    }

    return response()->json([
        'blog' => $blog
    ]);
}

}
