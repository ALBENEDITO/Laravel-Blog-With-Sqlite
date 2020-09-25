<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $term = ($request->has("term") ? $request->term : null);

        if ($term) {
            $posts = Post::where('title', 'LIKE', "%{$term}%")->get();
        } else {
            $posts = Post::all();
        }

        $categories = Category::all();
        return view('welcome', compact('posts','categories'));
    }
}
